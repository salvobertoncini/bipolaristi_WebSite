<?php
$dbhost = "localhost";
$dbname = "bipolaristi";
$dbuser = "salvo";
$dbpass = "salvo";
$connect = @mysql_connect($dbhost, $dbuser, $dbpass) or die (mysql_error());
@mysql_select_db($dbname) or die (mysql_error());
?>