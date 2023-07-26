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
            header('location:./login.php');
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
      <h1 style="color:#2691d9;">Create New Accoount</h1>
      <form method="post" action="newregister.php">
        <div class="txt_field">
        <input type="text" placeholder="Enter your Student Register Number" name="regno" value = "<?php if(isset($error)){echo $rno;}?>"/>
           <span></span>
           <label>Student Register Number</label> 
        </div>
        <div class="txt_field">
        <input type="email" placeholder="Enter your Email Address" name="email" value = "<?php if(isset($error)){echo $email;}?>"/>
          <span></span>
          <label>Email Address</label>
        </div>
        <div class="txt_field">
          <input type="password" placeholder="Enter Your Password" name="pwd"/>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" placeholder="Confirm Password" name="cpwd"/>
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

        <input class="signup-btn" style="background-color: #2691d9;" type="submit" value="SIGN UP" />
        <br/>
        <br/>
        <div class="sigunup_link">
        <p>Already have an account? <a href="./login.php">sign in</a></p>
        </div>
        <br/>
      </form>
    </div>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
<!--     
    <footer class="container-fluid bg-4 text-center">

    <p>Developed By Integrated M.Sc, ComputerScience Students</p>
    <div class="container" id="tag" style="background-color:  rgb(117, 209, 240);">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-google-plus"></i></a>
    <a href="#"><i class="fa fa-skype"></i></a>
    </div>
    </footer> -->


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
  .footer{
    align-content: border-bottom;
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
