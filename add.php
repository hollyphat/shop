<?php
session_id();
require("php/all.php");
if(!isset($_SERVER['HTTP_REFERER'])){
$_SESSION["info"] = "Invalid command";
header("location:index.php");
exit();
}
$qty =$_POST['qty'];
$pid = $_POST['invId'];
$sess =session_id();
$action = $_POST["action"];
switch ($action) {
	case 'add':
$sql = mysql_query("SELECT * FROM carttemp WHERE sess='$sess' AND invId='$pid'")
		or die(mysql_error());
		$tot = mysql_num_rows($sql);

		if($tot==0){
			//ok
			$insert = "INSERT INTO carttemp (sess,invId,qty) VALUES('$sess','$pid','$qty')";
			$query = mysql_query($insert) or die(mysql_error());
			$_SESSION["info"] = "Product addedd to cart successfully";
		}else{
			//echo "error";
			//echo json_encode($ok);
			$_SESSION["info"] = "Error, product already exist in your cart";
		}	
		break;
		case 'edit':
		$sql = mysql_query("SELECT * FROM carttemp WHERE sess='$sess' AND invId='$pid'")
		or die(mysql_error());
		$tot = mysql_num_rows($sql);

		if($tot>=1){
			//ok
			//$insert = "INSERT INTO carttemp (sess,invId,qty) VALUES('$sess','$pid','$qty')";
			$update = "UPDATE carttemp SET qty ='$qty' WHERE sess='$sess' AND invId='$pid'";
			$query = mysql_query($update) or die(mysql_error());
			$_SESSION["info"] = "Cart updated successfully";
		}else{
			$_SESSION["info"] = "Error, product does not exist in your cart";
		}
		break;
	}
$ref = $_SERVER['HTTP_REFERER'];

header("location:$ref");
exit();
//include("cart.php");
?>