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


// Update
if(isset($_REQUEST['requpdate'])){
    // Checking for Empty Fields
    if(($_REQUEST['stu_id'] == "") || ($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") 
    || ($_REQUEST['stu_pass'] == "" )|| ($_REQUEST['stu_pro'] == "")){
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"
    role="alert"> Fill All Fileds </div>';
     } else {
    // Assigning User Values to Variable

$sid = $_REQUEST['stu_id'];

$sname = $_REQUEST['stu_name'];

$semail = $_REQUEST['stu_email'];

$spass = $_REQUEST['stu_pass'];

$spro = $_REQUEST['stu_pro'];

$sql = "UPDATE student SET stu_id = '$sid', stu_name ='$sname', stu_email = '$semail', 
stu_pass= '$spass', stu_pro = '$spro' WHERE stu_id= '$sid'";

if($conn->query($sql) == TRUE) {
    //for successful submission
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2"
    role= "alert"> Updated Successfully </div>';
} else {
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2"
    role="alert"> Unable to Update </div>';
}

    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron" style="background: lightgray;">


<?php
if(isset($_REQUEST['view'])) {
$sql = "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
}

?>

<h3 class="text-center" style = "margin-top: 25px; font-size: 40px;font-weight: 600;font-family:Playfair Display">Update Student Details</h3>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_id">ID</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "stu_id" name="stu_id" value = "<?php if(isset($row['stu_id'])) { echo $row['stu_id']; } ?>" readonly>
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_name">Name</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "stu_name" name="stu_name" value = "<?php if(isset($row['stu_name'])) { echo $row['stu_name']; } ?>" >
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_email">Email</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "stu_email" name="stu_email" value = "<?php if(isset($row['stu_email'])) { echo $row['stu_email']; } ?>" readonly>
</div>  

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_pass">Password</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "stu_pass" name="stu_pass" value = "<?php if(isset($row['stu_pass'])) { echo $row['stu_pass']; } ?>" >
</div> 

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="stu_pro">Profession</label>
<input type="text" class= "form-control" id= "stu_pro " style= "margin-bottom:20px;margin-top: 20px;" name="stu_pro" value = "<?php if(isset($row['stu_pro'])) { echo $row['stu_pro']; } ?>" >
</div> 

<br>
<div class="text-center" >
<button type="submit" class="btn btn-danger" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px;" id="requpdate" name="requpdate">Update</button>
<a href="students.php" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px;" class="btn btn-secondary">Close</a>
</div>

<?php
if(isset($msg)){
    echo $msg; }
?>
</form>
</div>
</div>

</div> <!--Div row close from header-->
</div> 

<?php
include('./adminInclude/footer.php');
?>