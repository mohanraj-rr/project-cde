<?php
if(isset($_POST['request'])){
    include('../connect.php');   
    $req = $_POST['request'];

    if(isset($_POST['gid'])){

    }

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
            if(isset($_POST['gid'])){
                $gid = $_POST['gid'];
                $rowgid = $row['guideid'];
                if($rowgid == $gid){
        ?>

        <tr>
            <!-- <td><input name="gid" value= "<?php //echo $row['guideid']?>"/></td> -->
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['designation']?></td>
            <td><?php echo $row['college']?></td>
            <td><a href="./guidelist.php?gid=<?php echo $row['guideid']?>"><button class="button button1" name="select" type="submit" disabled>SELECT</button></a></td>
            <!-- <td><button type="submit" name="select">Select</button></td> -->
        </tr>

        <?php
                break;
                }
            }
        ?>
        <tr>
            <!-- <td><input name="gid" value= "<?php //echo $row['guideid']?>"/></td> -->
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['designation']?></td>
            <td><?php echo $row['college']?></td>
            <td><a href="./guidelist.php?gid=<?php echo $row['guideid']?>"><button class="button button1" name="select" type="submit">SELECT</button></a></td>
            <!-- <td><button type="submit" name="select">Select</button></td> -->
        </tr>
        <?php    
        }
        ?>
    </tbody>
    <a href="../student/home.php">home</a>    



<?php
}

?>