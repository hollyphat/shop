<?php
include_once 'php/all.php';
//print_r($_POST);
if(isset($_POST["login"])){

	extract($_POST);
	$user_id = clean($username);
	$password = clean($password);

	$sql = mysql_query("SELECT * FROM admin WHERE name='$user_id' and password='$password'") 
		or die(mysql_error());

	$total = mysql_num_rows($sql);

	if($total >= 1){ //ok
		$_SESSION["admin"] = $user_id;
		$_SESSION["info"] = "Login successfully";
		header("location:dashboard.php");
	}else{ //error
		$_SESSION["info"] = "Incorrect login details";
		header("location:admin.php");
	}
}else{
	header("location:index.php");
	exit();
}
?>