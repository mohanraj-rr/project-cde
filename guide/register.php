<?php
  include '../connect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $grno = mysqli_real_escape_string($conn, $_POST['gregno']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $cpwd = mysqli_real_escape_string($conn,$_POST['cpwd']);

  $error = "";
  $success = "";

  if(empty($grno)){
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

    $sql = "SELECT * FROM `guide` WHERE guideid ='$grno' AND emailid ='$email'";

    $res = mysqli_query($conn,$sql);

    if($res){
      $num = mysqli_num_rows($res);

      if($num == 1){
        $sql = "SELECT * FROM `guidelogin` WHERE guide_id ='$grno'";

        $res = mysqli_query($conn,$sql);

        $num = mysqli_num_rows($res);

        if($num > 0){
          $error =  "User already exists";
        }
        else{
          $sql = "INSERT INTO `guidelogin`(`guide_id`,`email_id`, `pwd`) VALUES ('$grno','$email','$pwd')";

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
    <title>Guide Register</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/frontStyle.css"> -->
    
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  outline-color: #a5b4fc;
  
}

body {
  min-height: 100vh;
  display: grid;
  place-items: center;
  /* background: linear-gradient(to right, #654ea3, #eaafc8); */
}

p {
  font-size: 17px;
  color: #2691d9;
}

.signup-form {
  width: 480px;
  padding: 32px;
  border-radius: 8px;
  background-color: white;
  box-shadow: 2px 4px 8px #2691d9;
  text-align: center;
}

.header {
  margin-bottom: 48px;
}

.header h1 {
  font-weight: bolder;
  font-size: 28px;
  color: #2691d9;
  
}

.input {
  position: relative;
  margin-bottom: 24px;
}

.input input {
  width: 100%;
  border: none;
  padding: 8px 40px;
  border-radius: 4px;
  background-color: #f3f4f6;
  color:#2691d9;
  font-size: 16px;
}

.input input::placeholder {
  color: #2691d9;
}

.input i {
  top: 50%;
  width: 36px;
  position: absolute;
  transform: translateY(-50%);
  color: #2691d9;
  font-size: 16px;
}

.signup-btn {
  width: 100%;
  border: none;
  padding: 8px 0;
  margin: 24px 0;
  border-radius: 20px;
  background-color: #2691d9;
  color: #ffffff;
  font-size: 16px;
  cursor: pointer;
}

.signup-btn:active {
  background-color: #4f46e5;
  transition: all 0.3s ease;
}

.social-icons i {
  height: 36px;
  width: 36px;
  line-height: 36px;
  border-radius: 50%;
  margin: 24px 8px 48px 8px;
  background-color: gray;
  color: #ffffff;
  font-size: 16px;
  cursor: pointer;
}

i.fa-facebook-f {
  background-color: #3b5998;
}

i.fa-twitter {
  background-color: #1da1f2;
}

i.fa-google {
  background-color: #dd4b39;
}

a {
  color: #6366f1;
  text-decoration: none;
}

</style>


  </head>
  <body>

    <h1 class="text-center">Guide Register Page</h1>

    <!-- <p style = "color: red">
      
      <?php
      // if (isset($error)){
      //   if($error != ''){
      //     echo '*';
      //     echo  $error;
      //   }
      // }
      ?>
    </p>
    <p style = "color: green">
      
      <?php
      // if (isset($success)){
      //   if($success != ''){
      //   echo '*';
      //   echo $success;
      //   }
      // } 
      ?>
    </p> -->

  <div class="signup-form">
  <div class="container">
    <div class="header">
      <h1 style="background-color: white;">Create an Account</h1>
    </div>
    <form method="post" action="register.php">
      <div class="input">
        <i class="fa-solid fa-user"></i>
        <input type="text" placeholder="Guide Register ID" name="gregno" value = "<?php if(isset($error)){echo $grno;}?>"/>
      </div>
      <div class="input">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" placeholder="Email Address" name="email" value = "<?php if(isset($error)){echo $email;}?>"/>
      </div>
      <div class="input">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="Password" name="pwd"/>
      </div>
      <div class="input">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="Confirm Password" name="cpwd"/>
      </div>
      
      <p style = "color: red">
      <?php
      if (isset($error)){
        if($error != ''){
          echo '* ';
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
      <input class="signup-btn" style="background-color: #2691d9;" type="submit" value="SIGN UP" />
    </form>
    <!-- <p>Or sign up with</p>
    <div class="social-icons">
      <i class="fa-brands fa-facebook-f"></i>
      <i class="fa-brands fa-twitter"></i>
      <i class="fa-brands fa-google"></i>
    </div> -->

    
    <p>Already have an account? <a href="./login.php">sign in</a></p>
  </div>
</div>

    <!-- <div class="container mt-5">
    <form method="post" action="register.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Register Number</label>
        <input type="text" class="form-control" placeholder="Enter Register Number" name="regno" value = "<?php //if(isset($error)){echo $rno;}?>"> 
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email Address</label>
        <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value = "<?php //if(isset($error)){echo $email;}?>">
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
    Already have an account? <a href="../student/login.php">Login now</a> -->

  </body>
</html>