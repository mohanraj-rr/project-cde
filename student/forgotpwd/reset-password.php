<?php
require 'connect.php';

$token = $_GET["token"];

$token_hash = hash("sha256",$token);

// echo $token_hash;

$sql = "SELECT * FROM `studlogin` WHERE `reset_token_hash`= '$token_hash'";

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

$regno = $row["regno"];
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
    <h2>helo</h2>
    <?php $token = $_GET["token"]?>
    <form action="reset-password.php?token=<?php echo $token?>" method="post">

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
      <input class="signup-btn" style="background-color: #2691d9;" name="confirm" type="submit" value="CONFIRM" />
    </form>
</body>
</html>
<?php
if(isset($_POST['confirm'])){

    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if($pwd != $cpwd){
        die("Incorrect password");
    }
    else{
        $sql = "UPDATE `studlogin` SET `pwd`='$pwd',`reset_token_hash`='NULL',`reset_token_expires_at`='NULL' WHERE `regno`='$regno'";
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
?>