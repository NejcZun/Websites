<?php
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "CP";

$db = new PDO("mysql:host=$host;port=$port",$username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("use `$database`");
?>