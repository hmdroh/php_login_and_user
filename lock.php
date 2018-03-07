<?php 
session_start();

if(!isset($_SESSION['Id']))
{
	
	echo "Click here to login...." . $level; // level will come it self from page
	header("Location: " . $level . "login.php");
	exit;
}

?>