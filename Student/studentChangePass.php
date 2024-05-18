<?php
if(!isset($_SESSION)){
session_start();
}
include('./stuInclude/header.php');
include_once('../dbConnection.php');

if(isset($_SESSION['is_login'])){
$stuEmail = $_SESSION['stuLogEmail'];
}
else {
echo "<script> location.href='../index.php'; </script>";
}

//$stuEmail = $_SESSION['stuLogEmail'];
if(isset($_REQUEST['stuPassUpdateBtn'])){
    if (($_REQUEST['stuNewPass'] == "")){
    // msg displayed if required field missing
    
    $passmsg = '<div class= "alert alert-warning col-sm-6 ml-5 mt-2"
    role="alert"> Fill All Fileds </div>';
    } else {
    
    $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
    $result = $conn->query($sql);
    
    if($result->num_rows == 1){
    
    $stuPass = $_REQUEST['stuNewPass'];
    
    $sql = "UPDATE student SET stu_pass = '$stuPass' WHERE
    stu_email = '$stuEmail'";
if($conn->query($sql) == TRUE){
        //below msg display on form submission
    
    $passmsg = '<div class = "alert alert-success col-sm-6 ml-5 mt-2" role = "alert">Updated Successfully</div>';
    } else {
        //below msg display on form submission failed
        $passmsg = '<div class = "alert alert-danger col-sm-6 ml-5 mt-2" role = "alert">Unable to Update</div>';
    }
}
    }
}

?>

<div class="col-sm-6 mt-5" style="background: #B9D9EB; margin-left: 200px;">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <h3 style="text-align: center;margin-top: 25px;font-size: 45px;font-weight: 700;font-family:Playfair Display">Change Password</h3>

<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="inputEmail">Email</label>
<input type="email" class="form-control" style= "margin-bottom:20px;margin-top: 20px;    width: 100%;"
id="inputEmail" value=" <?php echo $stuEmail ?>" readonly>
</div>
<div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
<label for="inputnewpassword">New Password</label>
<input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;    width: 100%;"
id="inputnewpassword" placeholder="New Password"
name="stuNewPass">
</div>
<button type="submit" class="btn btn-danger mr-4 mt-4" style= "width: 35%;border-radius: 25px;margin-left:100px;margin-top: 30px;background: #fd917e; margin-bottom:25px;border-color:#fd917e;"
name = "stuPassUpdateBtn"> Update </button>
<button type="reset" style="width: 35%;border-radius: 34px;margin-right: -5px;margin-bottom: 25px;" class="btn btn-secondary mt-4"> Reset </button>
<?php if(isset($passmsg)) {echo $passmsg; } ?>
</form>
</div>


<?php
include('./stuInclude/footer.php');
?>



    