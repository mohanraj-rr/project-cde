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
    $arr_abstract = preg_split("/ /",$abstract);///
    $objective = $_POST['objective'];
    $arr_objective = preg_split("/ /",$abstract);/////
    $scope = $_POST['scope'];
    $arr_scope = preg_split("/ /",$scope);/////
    $programlang = $_POST['programlang'];
    $platform = $_POST['platform'];
    $swapps = $_POST['swapps'];

    // $sql = "SELECT `title` FROM `projectreg`";

    // $result = mysqli_query($conn, $sql);

    // while($title_array = mysqli_fetch_assoc($result)){
    //     $existingtitle = $title_array['title'];
    //     $exist = preg_split("/ / ",$existingtitle);
    //     echo $exist;
    // }

    // $query = "SELECT * FROM `projectreg` WHERE `regno`='$regno'";

    // $res = mysqli_query($conn, $query);

    // $num = mysqli_num_rows($res);

    // if($num>0){
    //     //echo 'you already entered the form!!!';  
    //     header('location: ./home.php?Your Project Proposal Already Registered!');
    // }
    // else{
    // }

    $sql = "SELECT `title` FROM `projectreg`";

    $newtitle = strtolower($title);
    $result = mysqli_query($conn, $sql);
    $count=0;
    while($title_array = mysqli_fetch_assoc($result)){
        // $existingtitle = strtolower($title_array['title']);
        // $exist = preg_split("/ / ",$existingtitle);
        // $singletitle = preg_split("/ /",$title);
        // foreach($exist as $word){
        //     //echo $word.' occurrences '.substr_compare($title,$word,0).'<br />';
        //     foreach($singletitle as $title)
        //     if($word == $title){
        //         echo "successfully";
        //     }
        // }

        $exist = strtolower($title_array['title']);
        if($exist == $newtitle){
            $count += 1;
            //
            // header("location: ./projectreg.php");
        }
    }


        if($count>0){
            $title_error = "Title of the Project Already Exists!";
        }
        // else if(count($arr_abstract) < 20 && count($arr_abstract)>200){
        //     $abstract_error = "Enter abstract words more than 20 characters and less than 200 characters";
        // }
        // else if(count($arr_objective)<20 && count($arr_objective)>200){
        //     $objective_error = "Enter objective words more than 20 characters and less than 200 characters";
        // }
        // else if(count($arr_scope)>20 && count($arr_scope)<100){
        //     $scope_error = "Enter scope words more than 20 characters and less than 100";
        // }
        else{
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
    <form action="projectreg.php" method ="post" onsubmit="return validateForm()">    <!--   -->
        <label for="reg_number">Student Registration Number:</label>
        <input type="text" id="reg_number" name="regno" value='<?php echo $_SESSION['regno']?>' readonly>

        <label for="project_title">Title of the Project:</label>
        <input type="text" id="project_title" name="title" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" value="<?php if(isset($abstract_error) || isset($objective_error) || isset($scope_error)){echo $title;}?>" placeholder="<?php if(isset($title_error)){echo "Enter New Title";}?>"required>
        <span style="color: red;"><?php if(isset($title_error)){echo '*'.$title_error;}?></span><br><br>
        

        <label for="abstract">Abstract:</label><br>
        <textarea id="abstract" name="abstract" rows="5" cols="50" required><?php if(isset($title_error) || isset($objective_error) || isset($scope_error)){echo $abstract;}?></textarea><br>
        <!-- <span style="color: red;"><?php //if(isset($abstract_error)){echo '*'.$abstract_error;}?></span><br><br> -->
        <span id="abstractError" class="error"></span><br><br>

        <label for="objectives">Objectives:</label><br>
        <textarea id="objective" name="objective" rows="5" cols="50" required><?php if(isset($abstract_error) || isset($title_error) || isset($scope_error)){echo $objective;}?></textarea><br>
        <!-- <span style="color: red;"><?php //if(isset($objective_error)){echo '*'.$objective_error;}?></span><br><br> -->
        <span id="objectivesError" class="error"></span><br><br>

        <label for="scope">Scope:</label>
        <textarea id="scope" name="scope" rows="5" cols="50" required><?php if(isset($abstract_error) || isset($objective_error) || isset($title_error)){echo $scope;}?></textarea>
        <!-- <span style="color: red;"><?php //if(isset($scope_error)){echo '*'.$scope_error;}?></span><br><br> -->

        <label for="programming_languages">Programming Languages:</label>
        <input type="text" id="programming_languages" name="programlang" value="<?php if(isset($title_error) || isset($abstract_error) || isset($objective_error) || isset($scope_error)){echo $programlang;}?>" required>

        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform" value="<?php if(isset($title_error) || isset($abstract_error) || isset($objective_error) || isset($scope_error)){echo $platform;}?>" required>

        <label for="software_apps_tools">Software Apps and Tools:</label>
        <textarea id="software_apps_tools" name="swapps" rows="5" cols="50" required><?php if(isset($title_error) || isset($abstract_error) || isset($objective_error) || isset($scope_error)){echo $swapps;}?></textarea>

        <!-- <label for="guide_name">Guide (Supervisor/Instructor Name):</label>
        <input type="text" id="guide_name" name="guide_name" required>

        <label for="study_centre">Study Centre:</label>
        <input type="text" id="study_centre" name="study_centre" required> -->

        <input type="submit" name="submit" value="Submit Proposal">
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