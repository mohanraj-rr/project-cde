<?php
require 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST['submit'])){
    // echo "submit button pressed";
    


if(empty($_POST['regno'])){
    $error = "Register number field required";
}
else if(empty($_POST['email'])){
    $error = "Email ID field required";
}

$regno =  $_POST['regno'];
$email =  $_POST['email'];

$sql = "SELECT COUNT(`id`) AS val FROM `studlogin` WHERE `regno` = '$regno' AND `email`='$email'";
$res = mysqli_query($conn,$sql);

if($row = mysqli_fetch_array($res)){
    if($row['val']==1){
        // echo 'send reset link';
                
        $token = bin2hex(random_bytes(16));

        $token_hash = hash("sha256",$token);

        $expiry = date("Y-m-d H:i:s",time() + 60 * 30);

        $sql = "UPDATE `studlogin` SET `reset_token_hash`='$token_hash',`reset_token_expires_at`='$expiry' WHERE `regno`='$regno' AND `email`='$email'";
        $res = mysqli_query($conn,$sql);

        if($res){

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'mohanraj.windows.8121@gmail.com'; //from address
            $mail->Password = 'rowmgblyxcyhools';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
    
            $mail->setFrom('mohanraj.windows.8121@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'From CDE Project team';
            $mail->Body = "Click <a href='http://localhost/git_project/project-cde/student/forgotpwd/reset-password.php?token=$token'> here </a>to reset your password.";


            try{

                $mail->send();
                echo "Message sent, please check your inbox.";
        
            }catch(Exception $e){
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }


        }

    }
    else{
        echo 'email and regno incorrect!';
    }
}

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4" >
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center" style="color:#2691d9;">Forgot Password?</h2>
                  <p style="color:#2691d9;">You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="forgotpwd.php">
    
                      <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                          <input id="Register Number" name="regno" placeholder="Register Number" class="form-control"  type="Register Number">
                        </div>
                      </div>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="submit" class="btn-submit" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<style>
    .form-gap {
    padding-top: 70px;
}
.btn-submit{
  width: 100%;
  border: none;
  padding: 8px 0;
  border-radius: 20px;
  background-color: #2691d9;
  color: #ffffff;
  font-size: 16px;
  cursor: pointer;
}

</style>
</body>
</html>