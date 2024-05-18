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


if(isset ($_REQUEST['newStuSubmitBtn'])) {
    //Checking for Empty Fields
  
    if(($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") 
    || ($_REQUEST['stu_pro'] == "")){
    $msg = '<div class = "alert alert-warning col-sm-6 ml-5 mt-2">Please Fill All the Fields</div>';
}
else {
    $stu_name = $_REQUEST['stu_name'];
    $stu_email = $_REQUEST['stu_email'];
    $stu_pass = $_REQUEST['stu_pass'];
    $stu_pro = $_REQUEST['stu_pro'];

    $sql = "INSERT INTO student (stu_name, stu_email, stu_pass, stu_pro) 
    VALUES ('$stu_name', '$stu_email','$stu_pass','$stu_pro')";

if($conn->query($sql) == TRUE) {
$msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Student Added Succesfully</div>';

}
else {
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add New Student</div>';
}

}
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron" style="background: lightgray;">
<h3 class="text-center" style="margin-top: 25px ;font-size: 40px;font-weight: 600;font-family:Playfair Display">Add New Student</h3>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_name"> Name</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "stu_name" name="stu_name">
</div>


<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_email">Email</label>
<input type= "text" class = "form-control" style= "margin-bottom:20px;margin-top: 20px;" id="stu_email" name="stu_email"> 
</div>  

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_pass">Password</label>
<input type= "text" class = "form-control" style= "margin-bottom:20px;margin-top: 20px;" id="stu_pass" name="stu_pass"> 
</div> 

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_pro">Profession</label>
<input type= "text" class = "form-control" style= "margin-bottom:20px;margin-top: 20px;" id="stu_pro" name="stu_pro"> 
</div> 

<br>
<div class="text-center" >
<button type="submit" class="btn btn-danger" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px;" id="newStuSubmitBtn" name="newStuSubmitBtn">Submit</button>
<a href="students.php" class="btn btn-secondary" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px;">Close</a>
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