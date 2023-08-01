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

    
  
      $gt = 0;
      $i = 1;
      $html = '<!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>PDF Document</title>
          <style>
            h2 {
              font-family: Verdana, Geneva, Tahoma, sans-serif;
              text-align: center;
            }
            table {
              font-family: Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            td,
            th {
              border: 0.25rem solid #444;
              font-size: 1.1rem;
              text-align: left justify;
              padding: 1rem;
              line-height: 1.5;
            }
          </style>
        </head>
        <body>';
  
      while($row = mysqli_fetch_assoc($res1)){
          $html .= '<h2>Project CDE</h2>
          <table>
            <tbody>
              <tr>
                <th>Roll-No</th>
                <td>'.$row['regno'].'</td>
              </tr>
              <tr>
                <th>Title of The Project</th>
                <td>'.$row['title'].'</td>
              </tr>
              <tr>
                <th>Abstract</th>
                <td>'.$row['abstract'].'</td>
              </tr>
              <tr>
                <th>Objective</th>
                <td>'.$row['objective'].'</td>
              </tr>
              <tr>
                <th>Scope</th>
                <td>'.$row['scope'].'</td>
              </tr>
              <tr>
                <th>Programming Language</th>
                <td>'.$row['programlang'].'</td>
              </tr>
              <tr>
                <th>Platform</th>
                <td>'.$row['platform'].'</td>
              </tr>
              <tr>
                <th>Software Apps & Tools</th>
                <td>'.$row['swapps'].'</td>
              </tr>
            </tbody>
          </table>';
      }

      while($row = mysqli_fetch_assoc($res3)){
        $html .= '<h2>Guide Details</h2>
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
        </table>';}
  
      $dompdf = new Dompdf();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4','lnandscape');
      $dompdf->render();
      $fname = $rno.'-project.pdf';
      $dompdf->stream($fname);



?>




