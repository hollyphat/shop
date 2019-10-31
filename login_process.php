<?php
include_once 'php/all.php';
//print_r($_POST);
if(isset($_POST["login"])){

	extract($_POST);
	$user_id = clean($username);
	$password = clean($password);

	$sql = mysql_query("SELECT * FROM customer WHERE UserId='$user_id' and Password='$password'") 
		or die(mysql_error());

	$total = mysql_num_rows($sql);

	if($total >= 1){ //ok
		$_SESSION["uid"] = $user_id;
		if(isset($_POST["auto"])){
			$days = time() + 60 * 60 * 24 * 90;
			setcookie("e_mart_user",$user_id,$days);
		}
		$_SESSION["info"] = "Login successfully";
		header("location:index.php");
	}else{ //error
		$_SESSION["info"] = "Incorrect login details";
		header("location:login.php");
	}
}else{
	header("location:index.php");
	exit();
}
?>