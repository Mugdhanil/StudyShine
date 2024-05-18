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

$sql = "SELECT * FROM student WHERE stu_email = '".$stuEmail."'";
$result = $conn->query($sql);

if($result->num_rows == 1) {
$row = $result->fetch_assoc();

$stuId = $row["stu_id"];
}

if(isset($_REQUEST['submitFeedbackBtn'])){
    if($_REQUEST['f_content'] == "") {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"
        role="alert"> Write Anything </div>';
    } else {
        $fcontent = $_REQUEST["f_content"];
        $sql = "INSERT INTO feedback (f_content , stu_id) VALUES ('$fcontent','$stuId')";
        if($conn-> query($sql) == TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2"
role="alert"> Submitted Successfully </div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5" style="background: #B9D9EB; margin-left: 200px;">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <h3 style="text-align: center;margin-top: 25px;font-size: 45px;font-weight: 700;font-family:Playfair Display">Feedback</h3>
        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuId"> Student ID </label>
            <input type="text" class="form-control" style= "margin-bottom:20px;margin-top: 20px;"id= "stuId" name= "stuId" value="<?php if(isset($stuId)) {echo $stuId;} ?>" readonly>
        </div>
        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="f_content"> Your Feedback </label>
            <textarea class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id= "f_content" name= "f_content" row = 2></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style= " background: #fd917e;
    border-color: #fd917e; font-family:nunito sans;font-size:20px; width: 35%;border-radius: 25px;margin-left: 250px;margin-top: 30px;margin-bottom:12px"name= "submitFeedbackBtn">Submit </button>
        <?php if(isset($passmsg)) {echo $passmsg;} ?>
    </form>
</div>

<?php
include('./stuInclude/footer.php');
?>