<?php
if(!isset($_SESSION)){
	session_start();
}

include('./adminInclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])) {
$adminEmail = $_SESSION['adminLogEmail'];

} else {
	echo "<script> location.href= '../index.php'; </script>";
}


if(isset ($_REQUEST['lessonSubmitBtn'])) {
    //Checking for Empty Fields
  
    if(($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") 
    || ($_REQUEST['course_name'] == "")){
    $msg = '<div class = "alert alert-warning col-sm-6 ml-5 mt-2">Please Fill All the Fields</div>';
}
else {
    
    $lesson_name = $_REQUEST['lesson_name'];
    $lesson_desc = $_REQUEST['lesson_desc'];
    $course_id = $_REQUEST['course_id'];
    $course_name = $_REQUEST['course_name'];
    
    $lesson_link = $_FILES['lesson_link']['name'];
    $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
    $link_folder = '../videos/lessons/'.$lesson_link;
    move_uploaded_file($lesson_link_temp, $link_folder);

    $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name) 
    VALUES ('$lesson_name','$lesson_desc', '$link_folder', '$course_id','$course_name')";

if($conn->query($sql) == TRUE) {
$msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Lesson Added Succesfully</div>';

}
else {
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add New Lesson</div>';
}


}
}



?>

<div class="col-sm-6 mt-5 mx-3 jumbotron"  style="background: lightgray;">
<h3 style="text-align: center;margin-top: 25px;font-size: 40px;font-weight: 700;font-family:Playfair Display">Add New Lesson</h3>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_id">Course ID</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "course_id" name="course_id" value="<?php if(isset($_SESSION['course_id'])) {echo $_SESSION['course_id'];}?>" readonly>
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_name">Course Name</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "course_name" name="course_name" value="<?php if(isset($_SESSION['course_name'])) {echo $_SESSION['course_name'];}?>" readonly>
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for = "course_author">Lesson Name</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;"  id="lesson_name"name="lesson_name">
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="lesson_desc">Lesson Description</label>
<textarea class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="lesson_desc" name="lesson_desc" row=2></textarea>
</div>  

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for = "lesson_link">Lesson Video Link</label>
<input type="file" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="lesson_link" name="lesson_link">
</div>

<div class="text-center">
<button type="submit" class="btn btn-danger" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px" id="lessonSubmitBtn" name="lessonSubmitBtn">Submit</button>
<a href="lessons.php" style="width: 30%;border-radius: 34px;margin-right: 12px;" class="btn btn-secondary">Close</a>
</div>

<?php
if(isset($msg)){
    echo $msg; }
?>

</form>
</div>
</div> <!--Div row close from header-->
</div> <!--div Container-fluid close from header-->


<?php
include('./adminInclude/footer.php');
?>