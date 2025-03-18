<?php

$servername = 'localhost';
$username = 'new_user';
$dbpwd = 'new_password';
$dbname = 'elitefit';

$conn=mysqli_connect($servername,$username,$dbpwd,$dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

?>