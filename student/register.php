<?php
  include '../connect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $rno = mysqli_real_escape_string($conn, $_POST['regno']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $cpwd = mysqli_real_escape_string($conn,$_POST['cpwd']);

  $error = "";
  $success = "";

  if(empty($rno)){
    $error = "Register number field is required";
  }
  elseif(empty($email)){
    $error = "Email address field is required";
  }
  elseif(empty($pwd)){
    $error = "Password field is required";
  }
  elseif($pwd != $cpwd){
    $error = "Password does not match";
  }
  elseif(strlen($pwd)<8){
    $error = "Password must be atleast 8 characters long";
  }
  else{

    $sql = "SELECT * FROM `student` WHERE regno ='$rno' AND emailid ='$email'";

    $res = mysqli_query($conn,$sql);

    if($res){
      $num = mysqli_num_rows($res);

      if($num == 1){
        $sql = "SELECT * FROM `studlogin` WHERE regno ='$rno'";

        $res = mysqli_query($conn,$sql);

        $num = mysqli_num_rows($res);

        if($num > 0){
          $error =  "User already exists";
        }
        else{
          $sql = "INSERT INTO `studlogin`(`regno`,`email`, `pwd`) VALUES ('$rno','$email','$pwd')";

          $res = mysqli_query($conn, $sql);
        
          if($res){
            $success = "Signup Successfully";
            // $success = true;
          }
          else{
            die(mysqli_error($conn));
        }
          
      }
    }
    else{
      $error = "Invalid register number or email address!";
      // $invalid = true;
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
    <title>Student Register</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center">Student Register Page</h1>

    <p style = "color: red">
      
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
    <form method="post" action="register.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Register Number</label>
        <input type="text" class="form-control" placeholder="Enter Register Number" name="regno" value = "<?php if(isset($error)){echo $rno;}?>"> 
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email Address</label>
        <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value = "<?php if(isset($error)){echo $email;}?>">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" placeholder="Enter Confirm Password" name="cpwd">
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    Already have an account? <a href="../student/login.php">Login now</a>

  </body>
</html>

