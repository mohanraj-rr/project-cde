<?php
session_start();
require '../connect.php';
if(!isset($_SESSION['regno'])){
    header('location: ./login.php');
}

$regno = $_SESSION['regno'];

$sql = "SELECT * FROM `student` WHERE `regno`='$regno'";

$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)){

    //echo $row['name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $row['name'];?></span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">View Profile</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Course</label><input type="text" class="form-control" value="<?php echo $row['course'];?>" readonly></div>
                        <div class="col-md-6"><label class="labels">Specialization</label><input type="text" class="form-control" value="<?php if($row['specialization'] != NULL){ echo $row['specialization'];} else {echo "";}?>" readonly></div>
                        <!-- <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname" readonly></div> -->
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Register Number</label><input type="text" class="form-control" value="<?php echo $row['regno']?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Study Centre</label><input type="text" class="form-control"  value="<?php echo $row['studycentre']?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control"  value="<?php echo $row['emailid'] ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control"  value="<?php echo $row['phoneno'] ?>" readonly></div>
                        <!-- <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                        <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div> -->
                    </div>
                    <!-- <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                        <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                    </div> -->
                    <a href="./home.php"><div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button" style="background-color: rgb(15, 171, 223) ;">Back To Home</button></div></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>

<?php
}
else{
    die("Error");
}

?>