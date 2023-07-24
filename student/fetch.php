<?php
if(isset($_POST['request'])){
    include('../connect.php');   
    $req = $_POST['request'];

    $query = "SELECT * FROM `guide` WHERE `college` = '$req'";

    $res = mysqli_query($conn, $query);

    $count = mysqli_num_rows($res);
    
?>

<table class="table">
    <?php

    if($count){

    ?>

    <thead>
        <tr>
            <th>Guide ID</th>
            <th>Guide Name</th>
            <th>Designation</th>
            <th>College Name</th>
            <th>Accept Guide</th>
        </tr>
    <?php
    }
    else{
        echo "Sorry! no record found";
    }       
    ?>    
    </thead>
    
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($res)){
        ?>
        <tr>
            <td><input type="text" name="gid" value= "<?php echo $row['guideid']?>" readonly/></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['designation']?></td>
            <td><?php echo $row['college']?></td>
            <td><button type="submit" name="select">Select</button></td>
        </tr>
        <?php    
        }
        ?>
    </tbody>


<a href="../student/logout.php">Logout</a>

<?php
}

?>