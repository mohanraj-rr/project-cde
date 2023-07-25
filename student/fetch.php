<?php
if(isset($_POST['request'])){
    include('../connect.php');   
    $req = $_POST['request'];

    $query = "SELECT * FROM `guide` WHERE `college` = '$req'";

    $res = mysqli_query($conn, $query);

    $count = mysqli_num_rows($res);
    
?>

<table id="list" class="table">
    <?php

    if($count){

    ?>

    <thead>
        <tr>
            <!-- <th>Guide ID</th> -->
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
            <input type="hidden" name="gid" value= "<?php echo $row['guideid']?>"/></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['designation']?></td>
            <td><?php echo $row['college']?></td>
            <td><button class="button button1" name="select" type="submit">SELECT</button></td>
            <!-- <td><button type="submit" name="select">Select</button></td> -->
        </tr>
        <?php    
        }
        ?>
    </tbody>




<?php
}

?>