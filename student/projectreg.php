<?php
include '../connect.php';
session_start();

if(!isset($_SESSION['regno'])){
    header('location:login.php');
}
$rno = $_SESSION['regno'];
$query = "SELECT * FROM `projectreg` WHERE `regno`='$rno'";

$res = mysqli_query($conn, $query);

$num = mysqli_num_rows($res);

if($num>0){
    //echo 'you already entered the form!!!';  
    header('location: ./home.php?msg=Your Project Proposal Already Registered!');
}
else{
    if(isset($_POST['submit']))
{
    $regno = $_POST['regno'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $objective = $_POST['objective'];
    $scope = $_POST['scope'];
    $programlang = $_POST['programlang'];
    $platform = $_POST['platform'];
    $swapps = $_POST['swapps'];

    // $query = "SELECT * FROM `projectreg` WHERE `regno`='$regno'";

    // $res = mysqli_query($conn, $query);

    // $num = mysqli_num_rows($res);

    // if($num>0){
    //     //echo 'you already entered the form!!!';  
    //     header('location: ./home.php?Your Project Proposal Already Registered!');
    // }
    // else{
    // }


        $sql = "INSERT INTO `projectreg`(`regno`, `title`, `abstract`, `objective`, `scope`, `programlang`, `platform`, `swapps`) VALUES ('$regno','$title','$abstract','$objective','$scope','$programlang','$platform','$swapps')";

        $res = mysqli_query($conn,$sql);

        if($res){
            //echo "your project is successfully inserted!";
            header('location:./home.php?msg=Your Project Proposal Registered Successfully');
        }
        else{
            die(mysqli_error($conn));
        }


}

}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Proposal Page Form</title>
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

    <h1>Student Proposal Page Form</h1>
    <form action="projectreg.php" method ="post" onsubmit="return validateForm()"><!--  -->
        <label for="reg_number">Student Registration Number:</label>
        <input type="text" id="reg_number" name="regno" value='<?php echo $_SESSION['regno']?>' readonly>

        <label for="project_title">Title of the Project:</label>
        <input type="text" id="project_title" name="title" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" required>
        
        <label for="abstract">Abstract:</label><br>
        <textarea id="abstract" name="abstract" rows="5" cols="50" required></textarea><br>
        <span id="abstractError" class="error"></span><br><br>

        <label for="objectives">Objectives:</label><br>
        <textarea id="objectives" name="objective" rows="5" cols="50" required></textarea><br>
        <span id="objectivesError" class="error"></span><br><br>

        <label for="scope">Scope:</label>
        <textarea id="scope" name="scope" rows="5" cols="50" required></textarea>

        <label for="programming_languages">Programming Languages:</label>
        <input type="text" id="programming_languages" name="programlang" required>

        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform" required>

        <label for="software_apps_tools">Software Apps and Tools:</label>
        <textarea id="software_apps_tools" name="swapps" rows="5" cols="50" required></textarea>

        <!-- <label for="guide_name">Guide (Supervisor/Instructor Name):</label>
        <input type="text" id="guide_name" name="guide_name" required>

        <label for="study_centre">Study Centre:</label>
        <input type="text" id="study_centre" name="study_centre" required> -->

        <input type="submit" name="submit" value="Submit Proposal">
    </form>

</body>
<script>
  function validateForm() {
    if (!validateTextArea("abstract", 20, 200)) return false;
    if (!validateTextArea("objectives", 20, 200)) return false;
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
        return false;
    } else {
        var errorSpan = document.getElementById(textAreaId + "Error");
        errorSpan.innerHTML = "";
        return true;
    }
}


</script>
</html>