<?php

session_start();
include "../connect.php";

if(!isset($_SESSION['regno'])){
    header("../student/login.php");
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

  </style>
</head>
<body>

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
    
    <form action="" method="post"> 
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
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change',function(){
                var value = $(this).val();
                //alert(value);

                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data : 'request='+ value,

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

    if (isset($_POST['select']))  {

    $rno = $_SESSION['regno'];
    $gid = $_POST['gid'];
    $sql = "SELECT `name`, `phoneno`, `studycentre`, `course`, `specialization` FROM `student` WHERE `regno`='$rno'";

    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);

    $name = $row['name'];
    $phoneno = $row['phoneno'];
    $studycentre = $row['studycentre'];
    $course = $row['course'];
    $specialization = $row['specialization'];

    
    $query = "INSERT INTO `guideselection`(`regno`, `name`, `phoneno`, `studycentre`, `course`, `specialization`, `gid`, `status`) VALUES ('$rno','$name','$phoneno','$studycentre','$course','$specialization','$gid','Pending')";

    $sub = mysqli_query($conn,$query);
        
    if($sub>0){

      echo "your request is  under process! ";

    }
    else
    {

      echo "something went wrong ! ";
    }

   
  } 

    ?>
</body>
</html>