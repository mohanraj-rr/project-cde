<?php 
include("../connect.php");  
session_start();

if(!isset($_SESSION['gid'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<style>
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
.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #FEE12B;
}

.button2:hover {
  background-color: #FEE12B;
  color: brown;
}
.button3 {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.button3:hover {
  background-color: #f44336;
  color: white;
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

<body>
	

<h1 class="text-center  text-white bg-dark col-md-12">View Pending Student List</h1>
<!-- class="table table-bordered col-md-12" -->
<table id="list" >
  <thead>
    <tr>
      <th scope="col">Reg No</th>
	    <th scope="col">Name</th>
	    <th scope="col">Studycentre</th>
	    <th scope="col">Course</th>
	    <th scope="col">Specialization</th>
      <th scope="col">Phone No</th>
      <th scope="col">Project Proposal</th>
      <th scope='col'>Status</th>
    </tr>
  </thead>

<?php 
$gid = $_SESSION['gid'];

$query = "SELECT `regno`, `name`, `studycentre`, `course`, `specialization`,`phoneno`, `status` FROM `guideselection` WHERE `gid`='$gid' AND `status` = 'pending' ORDER BY id ASC";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result))  { ?>


  <tbody>
    <tr>
      <td scope="row"><?php echo $row['regno']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['studycentre']; ?></td>
      <td><?php echo $row['course']; ?></td>
      <td><?php echo $row['specialization']; ?></td>  
      <td><?php echo $row['phoneno']; ?></td> 
      <td><a href="../genPDF/generatePDF.php?regno=<?php echo $row['regno']?>">Preview</a></td> 
     <td>
		<form action="./approve.php" method="POST">
		<input type="hidden" name="regno" value="<?php echo $row['regno']; ?>"/>
    <button class="button button1" name="approve" value="approve">Approve</button>    
    <button class="button button2" name="crtpending" value="crtpending">Correction Pending</button>
    <button class="button button3" name="decline" value="decline">Decline</button>
		<!-- <input type="submit" name="approve" value="approve"> &nbsp &nbsp <br>
		<input type="submit" name="reject" value="reject">  -->

		</form>
   </td>
    </tr>
   
  </tbody>
  <?php } ?>
</table>


<?php 
if(isset($_POST['approve'])){

	$regno = $_POST['regno'];
	$select = "UPDATE `guideselection` SET `status`='Approved' WHERE `regno` = '$regno'";
	$res = mysqli_query($conn,$select);
	header("location:approve.php");
}


if(isset($_POST['decline'])){

	$regno = $_POST['regno'];
	$select = "UPDATE `guideselection` SET `status`='Declined' WHERE `regno` = '$regno'";
	$res = mysqli_query($conn,$select);
	header("location:approve.php");
}

if(isset($_POST['crtpending'])){

	$regno = $_POST['regno'];
	$select = "UPDATE `guideselection` SET `status`='Correction Pending' WHERE `regno` = '$regno'";
	$res = mysqli_query($conn,$select);
	header("location:approve.php");
}

 ?>






<!-- ================================================================== -->



 
&nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp  &nbsp 


 <h1 class="text-center  text-white bg-success col-md-12
">View Student List </h1>
<!-- class="table table-bordered col-md-12" -->
<table id="list" >
  <thead>
    <tr>
      <th scope="col">Reg No</th>
	    <th scope="col">Name</th>
	    <th scope="col">Studycentre</th>
	    <th scope="col">Course</th>
	    <th scope="col">Specialization</th>
      <th scope="col">Phone No</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

<?php

$gid = $_SESSION['gid'];

$query = "SELECT `regno`, `name`, `studycentre`, `course`, `specialization`,`phoneno`, `status` FROM `guideselection` WHERE `gid`='$gid' ORDER BY id ASC";
$result = mysqli_query($conn,$query);

// $query = "SELECT * FROM  `guideselec`";
// $result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result)) { ?>


  <tbody>
    <tr>
      <td scope="row"><?php echo $row['regno']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['studycentre']; ?></td>
      <td><?php echo $row['course']; ?></td>
      <td><?php echo $row['specialization']; ?></td>  
      <td><?php echo $row['phoneno']; ?></td>
      <td><?php echo $row['status']; ?></td>
    </tr>
  </tbody>

  <?php } ?>

</table>
<a href="./home.php">Home</a>
</body>
</html>