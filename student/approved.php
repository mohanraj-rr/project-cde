<?php

session_start();

if(!isset($_SESSION['regno'])){
    header('location:login.php');
}

?>

<!--Main Navigation-->
<html>
<head>
    <link href="https://cdn.usebootstrap.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.usebootstrap.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.usebootstrap.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/home.css">

</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>CDE STUDENT SECTION</h3>
        </div>

        <ul class="list-unstyled components">
            <p style="color: #fff;">Dashboard</p>
            <li class="active">
                <a href="#homeSubmenu">Home</a>
            </li>
            <li>
                <a href="./guidelist.php">Guide Selection</a>
            </li>
            <li>
                <a href="#">Project Registration</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Report Format</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="../pdf/student/firstreview.pdf">Review 1</a>
                    </li>
                    <li>
                        <a href="../pdf/student/secondreview.pdf">Review 2</a>
                    </li>
                    <!-- <li>
                        <a href="#">Review 3 Format</a>
                    </li> -->
                    <li>
                    <a href="#pageSubsubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Final Report</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="../pdf/student/reportMBA.pdf">MBA</a>
                    </li>
                    <li>
                        <a href="../pdf/student/reportMCA.pdf">MCA</a>
                    </li> 
                    </ul>   
                </ul>
            </li>
            <li>
                <a href="#">View Project Status</a>
            </li>
            <li>
                <a href="#">Profile</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="./logout.php" class="article">Signout</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" >

                <button type="button" id="sidebarCollapse" class="btn btn-info" style="background-color:rgb(15, 171, 223)">
                    <i class="fas fa-align-left"></i>
                    <span style="color: white;">Move</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <a class="navbar-brand" href="#">Student
                          </a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbar-list-4" >
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../img/stud.png" alt="Avatar" class="avatar">
                                </a> <?php echo $_SESSION['regno']; ?>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="./home.php">Dashboard</a>
                                  <a class="dropdown-item" href="#">Edit Profile</a>
                                  <a class="dropdown-item" href="./logout.php">Log Out</a>
                                </div>
                              </li>   
                            </ul>
                          </div>
                    </ul>
                </div>
            </div>
        </nav>

        <h2 style="text-align: center;">Your Request is Approved! Go to Project Registration Page!</h2>
        
    </div>
</div>

<script> 
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
   <h1 class="text-center text-success mt-5">Welcome
    
   </h1>

   <div class="container">
    <a href="../student/guidelist.php" class = "btn btn-primary mt-5">GuideList</a>
   </div>

   <div class="container">
    <a href="../student/logout.php" class = "btn btn-primary mt-5">Logout</a>
   </div>
</body>
</html> -->