<?php
/****************************************************************************
* Software: FPDF_Protection                                                 *
* Version:  1.02                                                            *
* Date:     2005/05/08                                                      *
* Author:   Klemen VODOPIVEC                                                *
* License:  Freeware                                                        *
*                                                                           *
* You may use and modify this software as you wish as stated in original    *
* FPDF package.                                                             *
*                                                                           *
* Thanks: Cpdf (http://www.ros.co.nz/pdf) was my working sample of how to   *
* implement protection in pdf.                                              *
****************************************************************************/

require('PDF_API.php');

class FPDF_Protection extends FPDF
{
	var $encrypted;          //whether document is protected
	var $Uvalue;             //U entry in pdf document
	var $Ovalue;             //O entry in pdf document
	var $Pvalue;             //P entry in pdf document
	var $enc_obj_id;         //encryption object id
	var $last_rc4_key;       //last RC4 key encrypted (cached for optimisation)
	var $last_rc4_key_c;     //last RC4 computed key

	//book mark variables
	var $outlines=array();
	var $OutlineRoot;

	function FPDF_Protection($orientation='P',$unit='mm',$format='A4')
	{
		parent::FPDF($orientation,$unit,$format);

		$this->encrypted=false;
		$this->last_rc4_key='';
		$this->padding="\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08".
						"\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
	}

	/**
	* Function to set permissions as well as user and owner passwords
	*
	* - permissions is an array with values taken from the following list:
	*   copy, print, modify, annot-forms
	*   If a value is present it means that the permission is granted
	* - If a user password is set, user will be prompted before document is opened
	* - If an owner password is set, document can be opened in privilege mode with no
	*   restriction if that password is entered
	*/


	function SetProtection($permissions=array(),$user_pass='',$owner_pass=null)
	{
		$options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32 );
		$protection = 192;
		foreach($permissions as $permission){
			if (!isset($options[$permission]))
				$this->Error('Incorrect permission: '.$permission);
			$protection += $options[$permission];
		}
		if ($owner_pass === null)
			$owner_pass = uniqid(rand());
		$this->encrypted = true;
		$this->_generateencryptionkey($user_pass, $owner_pass, $protection);
	}

/****************************************************************************
*                                                                           *
*                              Private methods                              *
*                                                                           *
****************************************************************************/

	function _putstream($s)
	{
		if ($this->encrypted) {
			$s = $this->_RC4($this->_objectkey($this->n), $s);
		}
		parent::_putstream($s);
	}

	function _textstring($s)
	{
		if ($this->encrypted) {
			$s = $this->_RC4($this->_objectkey($this->n), $s);
		}
		return parent::_textstring($s);
	}

	/**
	* Compute key depending on object number where the encrypted data is stored
	*/
	function _objectkey($n)
	{
		return substr($this->_md5_16($this->encryption_key.pack('VXxx',$n)),0,10);
	}

	/**
	* Escape special characters
	*/
	function _escape($s)
	{
		$s=str_replace('\\','\\\\',$s);
		$s=str_replace(')','\\)',$s);
		$s=str_replace('(','\\(',$s);
		$s=str_replace("\r",'\\r',$s);
		return $s;
	}

	/**
	* RC4 is the standard encryption algorithm used in PDF format
	*/
	function _RC4($key, $text)
	{
		if ($this->last_rc4_key != $key) {
			$k = str_repeat($key, 256/strlen($key)+1);
			$rc4 = range(0,255);
			$j = 0;
			for ($i=0; $i<256; $i++){
				$t = $rc4[$i];
				$j = ($j + $t + ord($k{$i})) % 256;
				$rc4[$i] = $rc4[$j];
				$rc4[$j] = $t;
			}
			$this->last_rc4_key = $key;
			$this->last_rc4_key_c = $rc4;
		} else {
			$rc4 = $this->last_rc4_key_c;
		}

		$len = strlen($text);
		$a = 0;
		$b = 0;
		$out = '';
		for ($i=0; $i<$len; $i++){
			$a = ($a+1)%256;
			$t= $rc4[$a];
			$b = ($b+$t)%256;
			$rc4[$a] = $rc4[$b];
			$rc4[$b] = $t;
			$k = $rc4[($rc4[$a]+$rc4[$b])%256];
			$out.=chr(ord($text{$i}) ^ $k);
		}

		return $out;
	}

	/**
	* Get MD5 as binary string
	*/
	function _md5_16($string)
	{
		return pack('H*',md5($string));
	}

	/**
	* Compute O value
	*/
	function _Ovalue($user_pass, $owner_pass)
	{
		$tmp = $this->_md5_16($owner_pass);
		$owner_RC4_key = substr($tmp,0,5);
		return $this->_RC4($owner_RC4_key, $user_pass);
	}

	/**
	* Compute U value
	*/
	function _Uvalue()
	{
		return $this->_RC4($this->encryption_key, $this->padding);
	}

	/**
	* Compute encryption key
	*/
	function _generateencryptionkey($user_pass, $owner_pass, $protection)
	{
		// Pad passwords
		$user_pass = substr($user_pass.$this->padding,0,32);
		$owner_pass = substr($owner_pass.$this->padding,0,32);
		// Compute O value
		$this->Ovalue = $this->_Ovalue($user_pass,$owner_pass);
		// Compute encyption key
		$tmp = $this->_md5_16($user_pass.$this->Ovalue.chr($protection)."\xFF\xFF\xFF");
		$this->encryption_key = substr($tmp,0,5);
		// Compute U value
		$this->Uvalue = $this->_Uvalue();
		// Compute P value
		$this->Pvalue = -(($protection^255)+1);
	}


	///// additonal functions  ////////////////////
	// to create watermark
		function RotatedText($x,$y,$txt,$angle)
		{
			//Text rotated around its origin
			$this->Rotate($angle,$x,$y);
			$this->Text($x,$y,$txt);
			$this->Rotate(0);
		}

		var $angle=0;

		function Rotate($angle,$x=-1,$y=-1)
		{
			if($x==-1)
				$x=$this->x;
			if($y==-1)
				$y=$this->y;
			if($this->angle!=0)
				$this->_out('Q');
			$this->angle=$angle;
			if($angle!=0)
			{
				$angle*=M_PI/180;
				$c=cos($angle);
				$s=sin($angle);
				$cx=$x*$this->k;
				$cy=($this->h-$y)*$this->k;
				$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
			}
		}

	// Function for Bookmark
	function Bookmark($txt,$level=0,$y=0)
	{
		if($y==-1)
			$y=$this->GetY();
		$this->outlines[]=array('t'=>$txt,'l'=>$level,'y'=>$y,'p'=>$this->PageNo());
	}

	function _putbookmarks()
	{
		$nb=count($this->outlines);
		if($nb==0)
			return;
		$lru=array();
		$level=0;
		foreach($this->outlines as $i=>$o)
		{
			if($o['l']>0)
			{
				$parent=$lru[$o['l']-1];
				//Set parent and last pointers
				$this->outlines[$i]['parent']=$parent;
				$this->outlines[$parent]['last']=$i;
				if($o['l']>$level)
				{
					//Level increasing: set first pointer
					$this->outlines[$parent]['first']=$i;
				}
			}
			else
				$this->outlines[$i]['parent']=$nb;
			if($o['l']<=$level and $i>0)
			{
				//Set prev and next pointers
				$prev=$lru[$o['l']];
				$this->outlines[$prev]['next']=$i;
				$this->outlines[$i]['prev']=$prev;
			}
			$lru[$o['l']]=$i;
			$level=$o['l'];
		}
		//Outline items
		$n=$this->n+1;
		foreach($this->outlines as $i=>$o)
		{
			$this->_newobj();
			$this->_out('<</Title '.$this->_textstring($o['t']));
			$this->_out('/Parent '.($n+$o['parent']).' 0 R');
			if(isset($o['prev']))
				$this->_out('/Prev '.($n+$o['prev']).' 0 R');
			if(isset($o['next']))
				$this->_out('/Next '.($n+$o['next']).' 0 R');
			if(isset($o['first']))
				$this->_out('/First '.($n+$o['first']).' 0 R');
			if(isset($o['last']))
				$this->_out('/Last '.($n+$o['last']).' 0 R');
			$this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]',1+2*$o['p'],($this->h-$o['y'])*$this->k));
			$this->_out('/Count 0>>');
			$this->_out('endobj');
		}
		//Outline root
		$this->_newobj();
		$this->OutlineRoot=$this->n;
		$this->_out('<</Type /Outlines /First '.$n.' 0 R');
		$this->_out('/Last '.($n+$lru[0]).' 0 R>>');
		$this->_out('endobj');
	}


	//function PDF_Code39 extends FPDF
	function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5, $showdetail = true){

		$wide = $baseline;
		$narrow = $baseline / 3 ; 
		$gap = $narrow;

		$barChar['0'] = 'nnnwwnwnn';
		$barChar['1'] = 'wnnwnnnnw';
		$barChar['2'] = 'nnwwnnnnw';
		$barChar['3'] = 'wnwwnnnnn';
		$barChar['4'] = 'nnnwwnnnw';
		$barChar['5'] = 'wnnwwnnnn';
		$barChar['6'] = 'nnwwwnnnn';
		$barChar['7'] = 'nnnwnnwnw';
		$barChar['8'] = 'wnnwnnwnn';
		$barChar['9'] = 'nnwwnnwnn';
		$barChar['A'] = 'wnnnnwnnw';
		$barChar['B'] = 'nnwnnwnnw';
		$barChar['C'] = 'wnwnnwnnn';
		$barChar['D'] = 'nnnnwwnnw';
		$barChar['E'] = 'wnnnwwnnn';
		$barChar['F'] = 'nnwnwwnnn';
		$barChar['G'] = 'nnnnnwwnw';
		$barChar['H'] = 'wnnnnwwnn';
		$barChar['I'] = 'nnwnnwwnn';
		$barChar['J'] = 'nnnnwwwnn';
		$barChar['K'] = 'wnnnnnnww';
		$barChar['L'] = 'nnwnnnnww';
		$barChar['M'] = 'wnwnnnnwn';
		$barChar['N'] = 'nnnnwnnww';
		$barChar['O'] = 'wnnnwnnwn'; 
		$barChar['P'] = 'nnwnwnnwn';
		$barChar['Q'] = 'nnnnnnwww';
		$barChar['R'] = 'wnnnnnwwn';
		$barChar['S'] = 'nnwnnnwwn';
		$barChar['T'] = 'nnnnwnwwn';
		$barChar['U'] = 'wwnnnnnnw';
		$barChar['V'] = 'nwwnnnnnw';
		$barChar['W'] = 'wwwnnnnnn';
		$barChar['X'] = 'nwnnwnnnw';
		$barChar['Y'] = 'wwnnwnnnn';
		$barChar['Z'] = 'nwwnwnnnn';
		$barChar['-'] = 'nwnnnnwnw';
		$barChar['.'] = 'wwnnnnwnn';
		$barChar[' '] = 'nwwnnnwnn';
		$barChar['*'] = 'nwnnwnwnn';
		$barChar['$'] = 'nwnwnwnnn';
		$barChar['/'] = 'nwnwnnnwn';
		$barChar['+'] = 'nwnnnwnwn';
		$barChar['%'] = 'nnnwnwnwn';

		$this->SetFont('Arial','',10);
		if ($showdetail) $this->Text($xpos, $ypos + $height + 4, $code);
		$this->SetFillColor(0);

		$code = '*'.strtoupper($code).'*';
		for($i=0; $i<strlen($code); $i++){
			$char = $code{$i};
			if(!isset($barChar[$char])){
				$this->Error('Invalid character in barcode: '.$char);
			}
			$seq = $barChar[$char];
			for($bar=0; $bar<9; $bar++){
				if($seq{$bar} == 'n'){
					$lineWidth = $narrow;
				}else{
					$lineWidth = $wide;
				}
				if($bar % 2 == 0){
					$this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
				}
				$xpos += $lineWidth;
			}
			$xpos += $gap;
		}
	}

	// for setting document view mode
		// use this parameters
		//$pdf->SetDisplayMode('fullpage');
		//$pdf->DisplayPreferences('HideMenubar,HideToolbar,HideWindowUI');
		var $DisplayPreferences='';

		function DisplayPreferences($preferences) {
			$this->DisplayPreferences.=$preferences;
		}

	function _putresources()
	{
		parent::_putresources();
		if ($this->encrypted){
			$this->_newobj();
			$this->enc_obj_id = $this->n;
			$this->_out('<<');
			$this->_putencryption();
			$this->_out('>>');
			$this->_out('endobj');
		}
		// detect book mark outline
		if(count($this->outlines)>0){
			$this->_putbookmarks();
		}
	}


	function _putencryption()
	{
		$this->_out('/Filter /Standard');
		$this->_out('/V 1');
		$this->_out('/R 2');
		$this->_out('/O ('.$this->_escape($this->Ovalue).')');
		$this->_out('/U ('.$this->_escape($this->Uvalue).')');
		$this->_out('/P '.$this->Pvalue);
	}

	function _puttrailer()
	{
		parent::_puttrailer();
		if ($this->encrypted) {
			$this->_out('/Encrypt '.$this->enc_obj_id.' 0 R');
			$this->_out('/ID [()()]');
		}
	}

	function _putcatalog()
	{
		parent::_putcatalog();
		if(is_int(strpos($this->DisplayPreferences,'FullScreen')))
			$this->_out('/PageMode /FullScreen');
		if($this->DisplayPreferences){
			$this->_out('/ViewerPreferences<<');
			if(is_int(strpos($this->DisplayPreferences,'HideMenubar')))
				$this->_out('/HideMenubar true');
			if(is_int(strpos($this->DisplayPreferences,'HideToolbar')))
				$this->_out('/HideToolbar true');
			if(is_int(strpos($this->DisplayPreferences,'HideWindowUI')))
				$this->_out('/HideWindowUI true');
			if(is_int(strpos($this->DisplayPreferences,'DisplayDocTitle')))
				$this->_out('/DisplayDocTitle true');
			if(is_int(strpos($this->DisplayPreferences,'CenterWindow')))
				$this->_out('/CenterWindow true');
			if(is_int(strpos($this->DisplayPreferences,'FitWindow')))
				$this->_out('/FitWindow true');
			$this->_out('>>');
		}
		// detect book mark outline
		if(count($this->outlines)>0){
			$this->_out('/Outlines '.$this->OutlineRoot.' 0 R');
			$this->_out('/PageMode /UseOutlines');
		}

	}
}

?>
