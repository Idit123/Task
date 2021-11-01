<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "pratical10";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die('Could not Connect MySql Server:');
}

?>