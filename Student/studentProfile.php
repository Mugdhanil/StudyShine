<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {

    echo "<script> location.href='../index.php'; </script>";
}

$sql = "SELECT * FROM student WHERE stu_email = '" . $stuEmail . "'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();

    $stuId = $row["stu_id"];

    $stuName = $row["stu_name"];
    $stuPro = $row["stu_pro"];
    $stuImg = $row["stu_img"];
}

if (isset($_REQUEST['updateStuNameBtn'])) {

    if (($_REQUEST['stuName'] == "")) {
        // msg displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"
    role="alert"> Fill All Fileds </div>';
    } else {
        $stuName = $_REQUEST["stuName"];
        $stuPro = $_REQUEST["stuPro"];
        $stu_image = $_FILES["stuImg"]["name"];
        $stu_image_temp = $_FILES["stuImg"]["tmp_name"];
        $img_folder = '../images/faces/' . $stu_image;
        move_uploaded_file($stu_image_temp, $img_folder);

        $sql = "UPDATE student SET stu_name = '$stuName', stu_pro =
'$stuPro', stu_img = '$img_folder' WHERE stu_email = '$stuEmail'";

        if ($conn->query($sql) == TRUE) {

            // below msg display on form submit success

            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2"
role="alert"> Updated Successfully </div>';
        } else {

            /// below msg display on form submit failed
            $passmsg = '<div class = "alert alert-danger col-sm-6 ml-5 mt-2"
role="alert"> Unable to Update </div>';
        }
    }
}
?>
<div class="col-sm-6 mt-5" style="background: #B9D9EB;margin-left: 200px;">
    <h3 style="text-align: center;margin-top: 25px;font-size: 45px;font-weight: 700;font-family:Playfair Display">Profile</h3>
    <form class="mx-5" method="POST" enctype="multipart/form-data" action="studentProfile.php">
        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuId">Student ID</label>
            <input type="text" class="form-control" style="margin-bottom:20px;margin-top: 20px;" id="stuId" name="stuId" value=" <?php if (isset($stuId)) {
                                                                                                                                        echo $stuId;
                                                                                                                                    } ?>" readonly>
        </div>
        <div class="form-group" style="font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuEmail">Email</label>
            <input type="email" class="form-control" style="margin-bottom:20px;margin-top: 20px;" id="stu_email" name="stu_email" value="<?php if (isset($row['stu_email'])) {
                                                                                                                                                echo $row['stu_email'];
                                                                                                                                            } ?>" readonly>
        </div>
        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuName">Name</label>
            <input type="text" class="form-control" style="margin-bottom:20px;margin-top: 20px;" id="stuName" name="stuName" value=" <?php if (isset($stuName)) {
                                                                                                                                            echo $stuName;
                                                                                                                                        } ?>">
        </div>

        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuPro">Profession</label>
            <input type="text" class="form-control" style="margin-bottom:20px;margin-top: 20px;" id="stuPro" name="stuPro" value=" <?php if (isset($stuPro)) {
                                                                                                                                        echo $stuPro;
                                                                                                                                    } ?>">
        </div>

        <div class="form-group" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
            <label for="stuImg">Upload Image</label>
            <input type="file" class="form-control-file" id="stuImg" name="stuImg" style="    font-size: 20px;
    font-family: nunito ui-sans-serif;
    font-weight: bold;">
        </div>

        <button type="submit" class="btn btn-primary" style="background: #fd917e;
      width: 20%;
      border-radius: 50px;
      border-color: #fd917e;
      font-size: 20px; 
      font-family: Nunito sans-serif;margin-top: 20px;
    margin-bottom: 14px;
    margin-left: 260px;" name="updateStuNameBtn"> Update </button>
        <?php if (isset($passmsg)) {
            echo $passmsg;
        } ?>
    </form>
</div>
</div>

<?php
include('./stuInclude/footer.php');
?>