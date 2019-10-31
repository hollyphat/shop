<?php
	session_start();
	//session_destroy();
	if(isset($_COOKIE["e_mart_user"])){
		//echo $_COOKIE["e_mart_user"];
		$now = time() - 60 * 60 * 24 * 90;
		setcookie("e_mart_user",$_SESSION["uid"],$now);
	}
	session_destroy();
	session_start();
	$_SESSION[info] = "Logout successfully";
	header("location:index.php");
	exit();
?>