<?php
session_start();
require '../connect.php';
if(!isset($_SESSION['regno'])){
    header('location: ./home.php');
}
$rno = $_SESSION['regno'];
$sql = "SELECT * FROM `guideselection` WHERE `regno`='$rno'";
$res = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($res);
if($rows){
    $check = $rows['status'];
    echo $check;
    if($check == 'Correction Pending'){
        $query = "SELECT * FROM `projectreg` WHERE `regno`='$rno'"; 
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){      
?>
        
<!DOCTYPE html>
<html>
<head>
    <title>Project Correcion Page</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
    }

    label {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .error {
        color: red;
    }
    </style>
</head>
<body>

    <a href="./home.php">BACK</a>
 

    <h1>Student Project Proposal Correction Page Form</h1>
    <form action="correctproject.php" method ="post" onsubmit="return validateForm()">    <!--  -->
        <label for="reg_number">Student Registration Number:</label>
        <input type="text" id="reg_number" name="regno" value='<?php echo $row['regno']?>' readonly>

        <label for="project_title">Title of the Project:</label> <!--onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" -->
        <input type="text" id="project_title" name="title" value='<?php echo $row['title']?>'  required>
        <span id="titleValidationMessage" style="color: red;"></span>
        <br>

        
        <label for="abstract">Abstract:</label><br>
        <textarea id="abstract" name="abstract"  rows="5" cols="50" required><?php echo $row['abstract']?></textarea><br>
        <span id="abstractError" class="error"></span><br><br>

        <label for="objectives">Objectives:</label><br>
        <textarea id="objective" name="objective" rows="5" cols="50" required><?php echo $row['objective']?></textarea><br>
        <span id="objectivesError" class="error"></span><br><br>

        <label for="scope">Scope:</label>
        <textarea id="scope" name="scope" rows="5" cols="50" required><?php echo $row['scope']?></textarea>

        <label for="programming_languages">Programming Languages:</label>
        <input type="text" id="programming_languages" name="programlang" value='<?php echo $row['programlang']?>' required>

        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform" value='<?php echo $row['platform']?>' required>

        <label for="software_apps_tools">Software Apps and Tools:</label>
        <textarea id="software_apps_tools" name="swapps" rows="5" cols="50" required><?php echo $row['swapps']?></textarea>

        <!-- <label for="guide_name">Guide (Supervisor/Instructor Name):</label>
        <input type="text" id="guide_name" name="guide_name" required>

        <label for="study_centre">Study Centre:</label>
        <input type="text" id="study_centre" name="study_centre" required> -->

        <input type="submit" name="submit" value="Edit Project Proposal">
    </form>

</body>
<script>
    // const titleInput = document.getElementById('project_title');
    // const titleValidationMessage = document.getElementById('titleValidationMessage');

    // const newTitle = titleInput.value.trim();
    // const existingTitles = <?php //echo json_encode($title_array['title']) ?>;
    // console.log(existingTitles);
    // if (existingTitles.includes(newTitle)) {
    //     titleValidationMessage.textContent = 'This name already exists.';
    //     textArea.focus();
    //     return false;
    // } else {
    //     titleValidationMessage.textContent = '';
    //     return true;
    // }

    function validateForm() {
        if (!validateTextArea("abstract", 20, 200)) return false;
        if (!validateTextArea("objective", 20, 200)) return false;
        // Add similar checks for other textareas with different limits
        return true;
    }

    function validateTextArea(textAreaId, minWords, maxWords) {
        var textArea = document.getElementById(textAreaId);
        var text = textArea.value.trim();
        var wordCount = text.split(/\s+/).length;

        if (wordCount < minWords || wordCount > maxWords) {
            var errorSpan = document.getElementById(textAreaId + "Error");
            errorSpan.innerHTML = "Please enter between " + minWords + " and " + maxWords + " words.";
            textArea.focus();
            return false;
        } else {
            var errorSpan = document.getElementById(textAreaId + "Error");
            errorSpan.innerHTML = "";
            return true;
        }
    }

    




</script>
</html>
  
<?php
        }
        //echo "update project proposal";
        //header("location: ./home.php?msg=wait");
    //     echo "<script>
    //     window.location = './home.php?msg=wait';
    // </script>";

    }
    else if($check == 'Pending'){
        header("location: ./home.php?msg=Wait for Guide Response");
    }
    else if($check == 'Approved'){
        header("location:./home.php?msg=Your request is approved");
    }
    else if($check == 'Declined'){
        header("location:./home.php?msg=Your request is Declined, Select a new Guide");
    }
}
else{
    echo "Error";
    header("location: ./home.php?msg=no data found");
}

if(isset($_POST["submit"])){
    $regno = $_POST['regno'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $objective = $_POST['objective'];
    $scope = $_POST['scope'];
    $programlang = $_POST['programlang'];
    $platform = $_POST['platform'];
    $swapps = $_POST['swapps'];

    $sql = "UPDATE `projectreg` SET `title`='$title',`abstract`='$abstract',`objective`='$objective',`scope`='$scope',`programlang`='$programlang',`platform`='$platform',`swapps`='$swapps' WHERE `regno`='$regno'";

    $res = mysqli_query($conn,$sql);

    if($res){
        $sql="UPDATE `guideselection` SET `status`='Pending' WHERE `regno` = '$regno'";
        $res = mysqli_query($conn,$sql);
        echo "<script>
        window.location = './home.php?msg=Wait for Guide Response';
        </script>";
        //echo "Updated Successfully";
    }
    else{
        die(mysqli_error($conn));
    }
}

?>

