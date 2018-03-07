<?php 

/*
$host = "localhost";
$user = "root";
$password = "";
*/


///
$host = "localhost";
$user = "productsurvey";
$password = "salesmeans99";

$domain = "farsales.com";
$db = "ppr_database";

$connection = @mysql_connect($host, $user, $password) or die("Unable to connect to server");
$databse = @mysql_select_db($db) or die ("Unable to select database");

global $connection;




?>