<?php
require 'connect.php';

$token = $_GET["token"];

$token_hash = hash("sha256",$token);

// echo $token_hash;

$sql = "SELECT * FROM `guidelogin` WHERE `reset_token_hash`= '$token_hash'";

$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($res);

if($row == NULL){
    die("token not found");
}
// echo strtotime($row["reset_token_expires_at"]);
// echo time();
if(strtotime($row["reset_token_expires_at"])<= time()){
    die("token has expired");
}

$gid = $row["guide_id"];
$error1 = "";
$error2 = "";
$error = "";
if(isset($_POST['submit'])){

    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if(empty($pwd)||empty($cpwd)){
        $error1 = "Please enter a password";
    }
    else if($pwd != $cpwd){
        $error2 = "Mismatch password";
    }
    else{
        $sql = "UPDATE `guidelogin` SET `pwd`='$pwd',`reset_token_hash`='NULL',`reset_token_expires_at`='NULL' WHERE `guide_id`='$gid'";
        $res = mysqli_query($conn, $sql);
        
        if($res){
            echo "Updated!";
            header("location: ../login.php?msg=password reset Successfully");
        }
        else{
            $error = "Error = " . mysqli_error($conn);
            header("location: ../login.php?msg='.$error.");
        }
    }

}
//echo "token is valid and hasn't expired";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
                  <h2 class="text-center" style="color:#2691d9;">Rest Password</h2>
                  <p style="color:#2691d9;">Change New Password</p>
                  <div class="panel-body">
                  <?php $token = $_GET["token"]?>
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="reset-password.php?token=<?php echo $token?>">
    
                      <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                          <input id="Register Number" name="pwd" placeholder="Enter New Password" class="form-control"  type="password">
                        </div>
                      </div>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="cpwd" placeholder="Enter Confirm Password" class="form-control"  type="password">
                        </div>
                      </div>
                      <p style="color: red;">
                        <?php
                            if (isset($error)){
                                if($error != ''){
                                echo '* ';
                                echo  $error;
                                }
                            }
                            if (isset($error1)){
                                if($error1 != ''){
                                echo '* ';
                                echo  $error1;
                                }
                            }
                            if (isset($error2)){
                                if($error2 != ''){
                                echo '* ';
                                echo  $error2;
                                }
                            }
                        ?>
                      </p>
                      <div class="form-group">
                        <input name="submit" class="btn-submit" value="Reset Password" type="submit">
                      </div>
                      
                      <!-- <input type="hidden" class="hide" name="token" id="token" value="">  -->
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




<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>helo</h2>
    <?php //$token = $_GET["token"]?>
    <form action="reset-password.php?token=<?php //echo $token?>" method="post">

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
        //
        ?>
      </p>
      <input class="signup-btn" style="background-color: #2691d9;" name="confirm" type="submit" value="CONFIRM" />
    </form>
</body>
</html> -->
<!-- <?php

?> -->