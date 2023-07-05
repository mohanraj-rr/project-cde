<?php

session_start();

if(!isset($_SESSION['regno'])){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
   <h1 class="text-center text-success mt-5">Welcome
    <?php echo $_SESSION['regno']; ?>
   </h1>


   <div class="container">
    <a href="../student/logout.php" class = "btn btn-primary mt-5">Logout</a>
   </div>
</body>
</html>