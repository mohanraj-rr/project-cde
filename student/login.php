<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include '../connect.php';

  $rno = mysqli_escape_string($conn,$_POST['regno']) ;
  $pwd = mysqli_escape_string($conn,$_POST['pwd']);

  $error = "";
  $success = "";

  if(empty($rno)){
    $error = "Register number field required";
  }
  else if(empty($pwd)){
    $error = "Password field required";
  }
  else{
  $sql = "SELECT * FROM `studlogin` WHERE regno ='$rno' AND pwd ='$pwd'";

  $res = mysqli_query($conn,$sql);

  if($res){
    $num = mysqli_num_rows($res);

    if($num > 0){
        // $success = true;
        $success = "Login Successfully";
        session_start();
        $_SESSION['regno'] = $rno;
        header('location:home.php');
    }
    else{
        // $invalid= true;
        $error = "Login Failed! (Invalid register number or credentials)";
    }
  }

  }



}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center">Student Login Page</h1>

    <p style="color: red;">
    <?php
      if (isset($error)){
        if($error != ''){
          echo '*';
          echo  $error;
        }
      }
      ?>
    </p>
    <p style = "color: green">
      
      <?php
      if (isset($success)){
        if($success != ''){
        echo '*';
        echo $success;
        }
      }
      ?>
    </p>

    <div class="container mt-5">
    <form method="post" action="login.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Register Number</label>
        <input type="text" class="form-control" placeholder="Enter Register Number" name="regno" value="<?php if(isset($error)){ echo "$rno";} ?>"> 
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    Don't have an account? <a href="../student/register.php">Signup now</a>
    </div>
  </body>
</html>

