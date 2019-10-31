<?php
session_id();
session_start();
require("php/all.php");
if(!isset($_SERVER['HTTP_REFERER'])){
$_SESSION["info"] = "Invalid command";
header("location:index.php");
exit();
}
$qty =$_POST['qty'];
$prodnum = $_POST['invId'];
$sess =session_id();
$sql = mysql_query("SELECT * FROM carttemp WHERE sess='$sess' AND invId='$pid'")
		or die(mysql_error());
		$tot = mysql_num_rows($sql);

		if($tot==0){
			//ok
			$insert = "INSERT INTO carttemp (sess,invId,qty) VALUES('$sess','$pid','$qty')";
			$query = mysql_query($insert) or die(mysql_error());
			$ok  = array('ok' => 'Success' );
			echo json_encode($ok);
		}else{
			//echo "error";
			$ok = array('ok' => 'Error' );
			echo json_encode($ok);
		}	
$ref = $_SERVER['HTTP_REFERER'];

$_SESSION["info"] = "Cart updated";
header("location:$ref");
exit();
//include("cart.php");
?>