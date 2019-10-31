<?php
	session_id();
	session_start();
	error_reporting('E_FATAL');
	/*$db_connect = mysql_connect("localhost","root","") or die(mysql_error());
	$db_select = mysql_select_db("shop") or die(mysql_error());*/

$db_connect = mysql_connect("remotemysql.com","TpFSro1j84","8S0m3XhzqB") or die(mysql_error());
$db_select = mysql_select_db("TpFSro1j84") or die(mysql_error());
	include 'function.php';
?>
