<?php
 
$user_name = 'root';
$password = '';
$database = 'monitoring';
$host_name = 'localhost';
$now = new DateTime();
$connect_db = mysqli_connect($host_name, $user_name, $password)or die(mysqli_error());

 
mysqli_select_db($connect_db, $database);
 
if ($connect_db) {
 
 echo "*";
}else {
 
 echo "#";
 
}
 
?>