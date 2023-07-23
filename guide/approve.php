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
<body>
	

<h1 class="text-center  text-white bg-dark col-md-12">View Pending Student List</h1>

<table class="table table-bordered col-md-12">
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

$query = "SELECT `regno`, `name`, `studycentre`, `course`, `specialization`,`phoneno`, `status` FROM `guideselection` WHERE `gid`='$gid' AND `status` = 'pending' ORDER BY id ASC";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result))  { ?>


  <tbody>
    <tr>
      <th scope="row"><?php echo $row['regno']; ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['studycentre']; ?></td>
      <td><?php echo $row['course']; ?></td>
      <td><?php echo $row['specialization']; ?></td>  
      <td><?php echo $row['phoneno']; ?></td>  
     <td>
		<form action="./approve.php" method="POST">
		<input type="hidden" name="regno" value="<?php echo $row['regno']; ?>"/>
		<input type="submit" name="approve" value="approve"> &nbsp &nbsp <br>
		<input type="submit" name="reject" value="reject"> 

		</form>
   </td>
    </tr>
   
  </tbody>
  <?php } ?>
</table>


<?php 
if(isset($_POST['approve'])){

	$regno = $_POST['regno'];
	$select = "UPDATE `guideselection` SET `status`='Approved' WHERE `regno` = '$regno' ";
	$res = mysqli_query($conn,$select);
	header("location:approve.php");
}


if(isset($_POST['reject'])){

	$regno = $_POST['regno'];
	$select = "UPDATE `guideselection` SET `status`='Rejected' WHERE `regno` = '$regno'  ";
	$res = mysqli_query($conn,$select);
	header("location:approve.php");
}

 ?>






<!-- ================================================================== -->



 
&nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp  &nbsp 


 <h1 class="text-center  text-white bg-success col-md-12
">View Student List </h1>

<table class="table table-bordered col-md-12">
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
      <th scope="row"><?php echo $row['regno']; ?></th>
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