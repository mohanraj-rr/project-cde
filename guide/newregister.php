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
    <title>Guide Register</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <li><a href="../index.html" style="font-weight: bolder;">HOME</a></li>
            <li><a href="../index.html" style="font-weight: bolder;">SERVICE</a></li>
            <li><a href="../index.html" style="font-weight: bolder;">CONTACT</a></li>
            <li><a href="../index.html" style="font-weight: bolder;">ABOUTUS</a></li>
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
        <input type="text" placeholder="Enter your Guide Register ID" name="gregno" value = "<?php if(isset($error)){echo $grno;}?>"/>
           <span></span>
           <label>Guide Register ID</label> 
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
          <label>Confirm Password</label>
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

    
<footer>
  <div class="footer">
      <p>Developed By Integrated M.Sc., CS and IT Students</p>
      <ul class="socials">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-github"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram "></i></a></li>
      </ul>
</footer>


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
    top: 45%;
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

  
  /*Footer*/

footer{
	position: absolute;
	bottom: 0;
	background: dodgerblue;
	height: auto;
	width: 100vw;
	padding: 1px 0 0 0;
}
/*content*/
.footer{
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	text-align: center;
}
.footer p{
    margin: 10px auto;
    line-height: 28px;
    font-size: 16px;
}
/*social -media*/
.socials{
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem 0 3rem 0;
}
.socials li{
    margin: 0 10px;
}
.socials a{
    text-decoration: none;
    color: #fff;
    border: 1.1px solid white;
    padding: 5px;
    border-radius: 50%;
}
.socials a i{
    font-size: 1.3rem;
    width: 20px;
    transition: color .4s ease;
}
.socials a:hover i{
    color: blue;
}
</style>
