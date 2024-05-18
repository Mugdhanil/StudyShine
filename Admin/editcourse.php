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
    if(($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") 
    || ($_REQUEST['course_author'] == "" )|| ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_price'] == "")
     || ($_REQUEST ['course_original_price'] == "")){
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"
    role="alert"> Fill All Fileds </div>';
     } else {
    // Assigning User Values to Variable

$cid = $_REQUEST['course_id'];

$cname = $_REQUEST['course_name'];

$cdesc = $_REQUEST['course_desc'];

$cauthor = $_REQUEST['course_author'];

$cduration = $_REQUEST['course_duration'];

$cprice = $_REQUEST['course_price'];
$coriginalprice = $_REQUEST['course_original_price'];

$cimg = '../images/Course/'.$_FILES['course_img']['name'];

$sql = "UPDATE course SET course_id = '$cid', course_name ='$cname', course_desc = '$cdesc', 
course_author= '$cauthor', course_duration= '$cduration', course_price='$cprice',
course_original_price= '$coriginalprice', course_img= '$cimg' WHERE course_id= '$cid'";

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
<h3 style="text-align: center;margin-top: 25px;font-family: Playfair-Display;font-size:40px;font-weight: 600;" class="text-center">Update Course</h3>

<?php
if(isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
}       
?>
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_id">Course ID</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "course_id" name="course_id" value = "<?php if(isset($row['course_id'])) { echo $row['course_id']; } ?>" readonly>
</div>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_name">Course Name</label>
<input type="text" class= "form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "course_name" name="course_name" value = "<?php if(isset($row['course_name'])) { echo $row['course_name']; } ?>">
</div>


<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_desc">Course Description</label>
<textarea class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="course_desc" name="course_desc" row=2><?php if(isset($row['course_desc'])) { echo $row['course_desc']; } ?></textarea>
</div>  

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for = "course_author">Author</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="course_author"name="course_author" value = "<?php if(isset($row['course_author'])) { echo $row['course_author']; } ?>" >
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_duration">Course Duration</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="course_duration" name="course_duration" value = "<?php if(isset($row['course_duration'])) { echo $row['course_duration']; } ?>" >
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_original_price">Course Original Price</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="course_original_price" name="course_original_price" value = "<?php if(isset($row['course_original_price'])) { echo $row['course_original_price']; } ?>">
</div>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_price">Course Selling Price</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="course_price" name="course_price" value = "<?php if(isset($row['course_price'])) { echo $row['course_price']; } ?>">
</div>


<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="course_img">Course Image</label>
<img src= "<?php if(isset($row['course_img'])) { echo $row['course_img']; }   ?>" alt="" class = "img-thumbnail">
<input type="file" class="form-control-file" style= "margin-bottom:20px;margin-top: 20px;" id="course_img" name="course_img">
</div>

<div class="text-center" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<button type="submit" class="btn btn-danger" style= "width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:35px" id="requpdate" name="requpdate">Update</button>
<a href="coursead.php" style="width: 30%;border-radius: 34px;margin-right: 12px;" class="btn btn-secondary">Close</a>
</div>
<?php
if(isset($msg)){
    echo $msg; }
?>

</form>
</div>
</div> <!--Div row close from header-->
</div> 


<?php
include('./adminInclude/footer.php');
?>