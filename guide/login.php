<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include '../connect.php';

  $gid = mysqli_escape_string($conn,$_POST['gregid']) ;
  $pwd = mysqli_escape_string($conn,$_POST['pwd']);

  $error = "";
  $success = "";

  if(empty($gid)){
    $error = "Register number field required";
  }
  else if(empty($pwd)){
    $error = "Password field required";
  }
  else{
    $sql = "SELECT * FROM `guidelogin` WHERE guide_id ='$gid' AND pwd ='$pwd'";

    $res = mysqli_query($conn,$sql);

    if($res){
      $num = mysqli_num_rows($res);

      if($num > 0){
          // $success = true;
          $success = "Login Successfully";
          session_start();
          $_SESSION['gid'] = $gid;
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
    <title>Guide Login</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/frontStyle.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
   
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="../index.html">CDE Project</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../index.html">HOME</a></li>
            <li><a href="../index.html">SERVICE</a></li>
            <li><a href="../index.html">CONTACT</a></li>
            <li><a href="../index.html">ABOUTUS</a></li>
        </ul>
        </div>
    </div>
    </nav>

    <!-- <h1 class="text-center">Guide Login Page</h1> -->

    
    <!-- <p style = "color: green">
      
      <?php
      // if (isset($success)){
      //   if($success != ''){
      //   echo '*';
      //   echo $success;
      //   }
      // }
      ?>
    </p> -->
    
    <div class="center"style="box-shadow: 2px 4px 8px #2691d9;">
      <h1 style="color:#2691d9;">Guide Login</h1>
      <form method="post" action="login.php">
        <div class="txt_field">
          <input type="text" placeholder="Register Number" name="gregid" value="<?php if(isset($error)){ echo "$gid";} ?>" />
           <span></span>
          <label>Guide Register ID</label>
        </div>
        <div class="txt_field">
          <input type="password" placeholder="Password" name="pwd" />
          <span></span>
          <label>Password</label>
        </div>

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

        <div class="pass"><a href="./forgotpwd/forgotpwd.php" style="text-decoration:none;">Forgot password?</a></div>
        <input type="submit" style="background-color: #2691d9;" value="Login">
        <br/>
        <br/>
        <div class="sigunup_link">
          Not a member?<a href="./newregister.php" style="text-decoration:none;">Signup</a>
        </div>
        <br/>
      </form>
    </div>

    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
  


  </body>
</html>

<style>
  body {
    margin: 0;
    padding: 0;
    font-family: montserrat;
    /* background: linear-gradient(120deg,#2980b9,#8e44ad); */
    height: 100vh;
    overflow: hidden;
  }
  .center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    border-radius: 10px solid #2691d9;
    
  }
  .center h1{
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1px solid silver;
    
  }
  .center form{
    padding: 0 40px;
    box-sizing: border-box;
  }
  form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
  }
  .txt_field input {
   width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
  }
  .txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    pointer-events:none;
  }
  .txt_field span::before{
    content:' ';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0;
    height: 2px;
    background: #2691d9;
    transition: .5s;
    
  }
  .txt_field input:focus ~ label,
  .txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
  }
  .txt_field input:focus ~ span::before,
  .txt_field input:valid ~ span::before{
    width: 100%;
  }
  .pass {
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
  }
  input[type="submit"]{
    width:100%;
    height: 50px;
    border: 1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color: #e9f4fb;
    font-weight: 700;
    outline: none;
  }
  input[type="submit"]:hover{
    border-color: #2691d9;
    transition: .5s;
  }
  .signup_link{
    margin: 30px 0;
    text-align: center;
    font-size: 16px;
    color: #666666;
  }
  .signup_link a{
    color: #2691d9;
    text-decoration: none;
  }
  .signup_link a:hover{
    text-decoration: underline;
  }
</style>

  <!-- <div class="signup-form">
    <div class="container">
    <div class="header">
      <h1 style="background-color: white;" >Create an Account</h1>
    </div>
    <form method="post" action="login.php">
      <div class="input" >
        <i class="fa-solid fa-user"></i>
        <input type="text" placeholder="Register Number" name="regno" value="<?php //if(isset($error)){ echo "$rno";} ?>"/>
      </div>
      <div class="input">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="Password" name="pwd"/>
      </div>
      
      


      <input class="signup-btn" type="submit" value="SIGN IN" />
    </form>
     <p>Or sign up with</p>
    <div class="social-icons">
      <i class="fa-brands fa-facebook-f"></i>
      <i class="fa-brands fa-twitter"></i>
      <i class="fa-brands fa-google"></i>
    </div> 
    <p> Don't have an account? <a href="./register.php">Sign Up</a></p>
  </div> -->
  
  
    <!-- <div class="container mt-5">
    <form method="post" action="login.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Register Number</label>
        <input type="text" class="form-control" placeholder="Enter Register Number" name="regno" value="<?php //if(isset($error)){ echo "$rno";} ?>"> 
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    Don't have an account? <a href="../student/register.php">Signup now</a>-->