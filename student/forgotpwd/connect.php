<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "project-cde";

$conn = mysqli_connect($hostname, $username, $password,$dbname);

if(!$conn){
    die(mysqli_error($conn));
}

?>