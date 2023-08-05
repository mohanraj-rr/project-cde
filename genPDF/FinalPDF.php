<?php 
  session_start();
  if(!isset($_SESSION['regno'])){
    echo "Error!";
  }

  require '../connect.php';

  require_once('./dompdf/autoload.inc.php');

  use Dompdf\Dompdf;
  
      // $conn = new PDO('mysql:host=localhost;dbname=project_database','root','');
  
      // $sql = 'SELECT * FROM projects';
      // $stmt = $conn->prepare($sql);
      // $stmt->execute();
      // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      $rno = $_SESSION['regno'];

      $sql1 = "SELECT * FROM `projectreg` WHERE `regno`='$rno'";
  
      $res1 = mysqli_query($conn, $sql1);

      $sql2 = "SELECT `gid` FROM `guideselection` WHERE `regno`='$rno'";

      $res2 = mysqli_query($conn, $sql2);

      $row = mysqli_fetch_array($res2);

      $gid = $row['gid'];

      $sql3 = "SELECT `name`, `designation`, `college`, `emailid`, `phoneno` FROM `guide` WHERE `guideid`='$gid'";

      $res3 = mysqli_query($conn, $sql3);

      $sql4 = "SELECT `name` FROM `student` WHERE `regno`='$rno'";
      
      $res4 = mysqli_query($conn,$sql4);

      $row1 = mysqli_fetch_assoc($res4);

    
  
      $gt = 0;
      $i = 1;
      $html = '<!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>PDF Document</title>
          <style>
            h1 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              text-align: center;
            }
            h2 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              text-align: center;
            }
            h3 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              text-align: center;
            }
            h4 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              font-size:1.1rem;
              text-align: left justify;
              font-weight:bold;

            }
            h5 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              font-size:1.1rem;
              font-weight:normal;
              text-align: justify;
              line-height: 1.5;
            }
             p{
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              font-size:1.1rem;
              font-weight:500;
              position: absolute;
              top:94.8%;
              left:11%;
            }
            h6{
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              font-size:1.1rem;
              font-weight:500;
              position: absolute;
              top:92.5%;
              left:65%;
            }


            table {
              font-family: Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            td,
            th {
              border: 0.15rem solid #444;
              font-size: 1.1rem;
              text-align: justify;
              padding: 0.4rem;
              line-height: 1.5;
            }
          </style>
        </head>
        <body>';
  
      while($row = mysqli_fetch_assoc($res1)){
          $html .= '<img src="./genPDF/3.png">
          <h1>ANNA UNIVERSITY</h1>
          <h2>CENTRE FOR DISTANCE EDUCATION</h2>
          <h3>CHENNAI - 600 025</h3>
          <h3>Project Details</h3>
          <table>
            <tbody>
              <tr>
                <th>Roll-No</th>
                <td>'.$row['regno'].'</td>
              </tr>
              <tr>
                <th>Name</th>
                <td>'.$row1['name'].'</td>
              </tr>
              <tr>
                <th>Title of the Project</th>
                <td>'.$row['title'].'</td>
              </tr>
              <tr>
                <th>Objective</th>
                <td>'.$row['objective'].'</td>
              </tr>
            </tbody>
          </table>';
      }

      while($row = mysqli_fetch_assoc($res3)){
        $html .= '<h3>Guide Details</h3>
        <table>
          <tbody>
            <tr>
              <th>Guide Name</th>
              <td>'.$row['name'].'</td>
            </tr>
            <tr>
              <th>Guide Designation</th>
              <td>'.$row['designation'].'</td>
            </tr>
            <tr>
              <th>College</th>
              <td>'.$row['college'].'</td>
            </tr>
            <tr>
              <th>Email-id</th>
              <td>'.$row['emailid'].'</td>
            </tr>
          </tbody>
        </table>
        <h4><u>Declaration:</u></h4>
        <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;I hereby declare that all the details provided above are true to the best of my knowledge. I hereby confirm that all the facts stated above are accurate to the best of my belief. The information stated above is true to the best of my knowledge and belief.</h5>
        <p> Signature of the Student</p>
        <h6> Signature of the Guide</h6>'
       
        ;}

  
      $dompdf = new Dompdf();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4','lnandscape');
      $dompdf->render();
      $fname = $rno.'-project.pdf';
      $dompdf->stream($fname);

?>




