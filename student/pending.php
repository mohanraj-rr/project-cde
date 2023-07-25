<?php
session_start();
if(!isset($_SESSION['regno'])){
    header("location:./login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Your Request on Pending</h1>
    <a href="./home.php">home</a>
</body>
</html>