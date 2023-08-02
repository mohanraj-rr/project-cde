<?php

session_start();
include "../connect.php";

if(!isset($_SESSION['regno'])){
    header("location:login.php");
}

$regno = $_SESSION['regno'];

$qry = "SELECT * FROM `projectreg` WHERE `regno`='$regno'";

$result = mysqli_query($conn, $qry);

$num = mysqli_num_rows($result);

if($num==0){
    // echo "First register your project proposal";
    header("location:./home.php?msg=Register your Project Proposal First");
}


$query = "SELECT * FROM `guideselection` WHERE `regno` = '$regno'";

$res = mysqli_query($conn, $query);

$val = mysqli_num_rows($res);

if($val>0){
    $sql = "SELECT `status` FROM `guideselection` WHERE `regno` = '$regno'";

    $res = mysqli_query($conn, $sql);

    $status = mysqli_fetch_array($res);

    $check = $status["status"];

    if($check == "Approved"){
        header("location:./home.php?msg=Your request is approved");
        // echo '<script>alert("Your request is approved!")</script>';
    }
    else if($check == "Pending"){
        header("location:./home.php?msg=Your request is pending");
    }
    else if($check == "Declined"){
        //echo "You are rejected select again.";
        echo '<script>alert("Your request is Declined! Select a new Guide")</script>';
        $sql = "DELETE FROM `guideselection` WHERE `regno` = '$regno' AND `status` = '$check'";
        $res = mysqli_query($conn,$sql);
    }
    else if($check == "Correction Pending"){
        header("location:./home.php?msg=Your request is correction pending");//want to add header
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


if (isset($_GET['gid']))  {

$rno = $_SESSION['regno'];
$gid = $_GET['gid'];
// if(isset($_GET['gid'])){
//     $gid = $_GET['gid'];
// }
// else{
//     echo "gid is missing";
// }






$sql = "SELECT `name`, `phoneno`, `studycentre`, `course`, `specialization`,`emailid` FROM `student` WHERE `regno`='$rno'";

$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);

$name = $row['name'];
$phoneno = $row['phoneno'];
$studycentre = $row['studycentre'];
$course = $row['course'];
$specialization = $row['specialization'];
$studemail = $row['emailid'];

$query = "SELECT `emailid` FROM `guide` WHERE `guideid`='$gid'";
$res = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($res);

$email = $row['emailid'];


$query = "SELECT COUNT(`gid`) AS `nguide` FROM `guideselection` WHERE `gid` = '$gid'";
$res = mysqli_query($conn, $query);


if($res){
    $nguide = mysqli_fetch_assoc($res);

    $val = $nguide['nguide'];
    if($val>2){
        
        header('location:./guidelist.php?msg='.$gid);
        
    }
    else{

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
        $mail->Body = 'Login in to guide line to select the requested students :'.$name.'-'. $studycentre.'-'.$course.'-'.$studemail.'-'.$phoneno.''.'<br>'.'<a href="http://localhost/git_project/project-cde/guide/login.php">Click to Guide login</a>';
        $mail->AltBody = '<a href="http://localhost/git_project/project-cde/guide/login.php">Click to Guide login</a>';
        $mail->send();

        $query = "INSERT INTO `guideselection`(`regno`, `name`, `phoneno`, `studycentre`, `course`, `specialization`, `gid`, `status`) VALUES ('$rno','$name','$phoneno','$studycentre','$course','$specialization','$gid','Pending')";

        $sub = mysqli_query($conn,$query);
            
            if($sub){
    
            // echo "your request is  under process! ";
            // echo "<script>window.location.href='home.php?msg=your guide selection request send to corresponding guide;</script>";  

            header('location: ./home.php?msg=your guide selection request sent to corresponding guide');
            
    
    
            }
            else
            {
            echo "something went wrong ! ";
            } 

    }
   
}





} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Guide List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 

  <style type="text/css">
    body{
        margin: 0;
        padding: 0;
        font-family: "helvetica", sans-serif;
    }
    #filter{
        margin-left: 10%;
        margin-top: 2%;
        margin-bottom: 2%;
    }
    #list {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #list td, #list th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #list tr:nth-child(even){background-color: #f2f2f2;}

    #list tr:hover {background-color: #ddd;}

    #list th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: blue;
    color: white;
    }

    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    }

    .button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
    }

    .button1:hover {
    background-color: #4CAF50;
    color: white;
    }

  </style>
</head>
<body>
    <?php
    if(isset($_GET['msg'])){
        echo "<script>alert('Same Guide Selected N times, So Select Another Guide')</script>";
    }
    ?>

    <h1 class="text-center text-success mt-5">Welcome
    <?php echo $_SESSION['regno']; ?>
    </h1>



    <div id="filter">
        <span>Fetch results by &nbsp;</span>
        <select name="fetchval" id="fetchval">
            <option value="" disabled="" selected="">Select College Name</option>
            <option value="College of Engineering, Guindy">College of Engineering, Guindy</option>
            <option value="Madras Institute of Technology, Chromepet">Madras Institute of Technology, Chrompet</option>
            <option value="Center of Distance Education, Guindy">Center of Distance Education, Guindy</option>
            <option value="Alagappa College of Technology, Guindy">Alagappa College of Technology, Guindy</option>   
        </select>
    </div>
    
     
    <div class="container">
        <table id="list" class="table">
            <thead>
                <tr>
                    <th>Guide Name</th>
                    <th>Designation</th>
                    <th>College Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM `guide`";
                $res = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['designation']?></td>
                    <td><?php echo $row['college']?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="../student/home.php">home</a>
    </div>
    

    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change',function(){
                var value = $(this).val();

                const mykeyValues = window.location.search;
                const urlParams = new URLSearchParams(mykeyValues);

                const params1 = urlParams.get('msg');
                console.log(params1);
                //alert(value);

                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data : {request : value, gid: params1},

                    beforeSend:function(){
                        $(".container").html("<span>Working on...</span>");
                    },
                    success:function(data){
                        $(".container").html(data);
                    }
                });
            });

        });

    </script>


    <?php



    ?>
</body>
</html>
