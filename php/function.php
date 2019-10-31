<?php
//function file

function loggedin(){
		if(isset($_COOKIE["e_mart_user"])){
			$_SESSION["uid"] = $_COOKIE["e_mart_user"];
		}

		if(isset($_SESSION['uid'])){
			return true;
		}else{
			return false;
		}
	}

	function categories(){
		$q = mysql_query("SELECT * FROM categories ORDER BY RAND() LIMIT 5") 
			or die(mysql_error());

			while ($rs=mysql_fetch_assoc($q)) {
				echo "<li><a href='category.php?id=".$rs['id']."'>".$rs['name']."</li>";
			}
	}

	function clean($string){
		return trim(htmlentities(addslashes($string)));
	}

	function info(){
		if(isset($_SESSION["info"])){
			$info = $_SESSION["info"];
			echo "<div class='alert alert-info text-center'>".$info;
			echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			echo "</div>";
			unset($_SESSION["info"]);
		}

	}

	function admin(){ //function to check for admin
		if(isset($_SESSION["admin"])){
			return true;
		}else{
			return false;
		}
	}
	
	function category($cat){
		$s = mysql_fetch_assoc(mysql_query("SELECT name FROM categories WHERE id='$cat'"));
		return $s["name"];
	}

	function cart(){ //function to check shopping cart
		$sess = session_id();
		$sql = "SELECT * FROM carttemp WHERE sess='$sess'";
		$query = mysql_query($sql);
		$total = mysql_num_rows($query);
		return $total;
	}

	function cost($prod){ //function for product cost
		$sql = mysql_fetch_assoc(mysql_query("SELECT InvPrice FROM inventory WHERE id='$prod'"));
		return $sql["InvPrice"];
	}

	function price($session){ //function for total price
		$sql = "SELECT * FROM carttemp WHERE sess='$session'";
		$query = mysql_query($sql);
		$total = mysql_num_rows($query);
		if($total==0){
			return 0;
		}else{
			$sum = 0;
			while($rs=mysql_fetch_assoc($query)){
				$invId = $rs["invId"];
				$qty = $rs["qty"];
				$sum = (cost($invId) * $qty) + $sum;
			}

			return number_format($sum,2,'.',' ');
		}
	}

	//user details

	function user($value){
		$uid = $_SESSION["uid"];
		$sql = "SELECT * FROM customer WHERE UserId='$uid'";
		$query = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($query);
		return $row[$value];
	}
?>