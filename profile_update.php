<?php
	include_once 'php/all.php';
	if(!loggedin()){
        header("location:index.php");
        exit();
    }

    if(!isset($_POST["ok"])){
    	header("location:index.php");
        exit();
    }

    extract($_POST);

    $on_line = user("id");

    $sql = "UPDATE customer SET Password='$password', FirstName='$fname', LastName='$lname', 
    Address ='$address', City='$city', State='$state', 
    Zip ='$zip', Email='$email', Phone='$phone' WHERE id='$on_line'";

    $query = mysql_query($sql) or die(mysql_error());

    $_SESSION["info"] = "Profile updated successfully";
    header("location:profile.php");
    exit();
?>