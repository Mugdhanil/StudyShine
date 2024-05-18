<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href= '../index.php'; </script>";
}

$adminEmail = $_SESSION['adminLogEmail'];
if (isset($_REQUEST['adminPassUpdatebtn'])) {
    if (empty($_REQUEST['adminPass'])) {
        // Message displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $adminPass = $_REQUEST['adminPass'];
        // Check password validity
        if (strlen($adminPass) < 8) {
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password must be at least 8 characters long </div>';
        } elseif (!preg_match("#[0-9]+#", $adminPass)) {
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password must include at least one number </div>';
        } elseif (!preg_match("#[A-Z]+#", $adminPass)) {
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password must include at least one uppercase letter </div>';
        } elseif (!preg_match("#[a-z]+#", $adminPass)) {
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password must include at least one lowercase letter </div>';
        } elseif (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $adminPass)) {
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password must include at least one special character </div>';
        } else {
            // Hash the password
            $hashed_password = password_hash($adminPass, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM admin WHERE admin_email='$adminEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $sql = "UPDATE admin SET admin_pass = '$hashed_password' WHERE admin_email = '$adminEmail'";
                if ($conn->query($sql) == TRUE) {
                    // Display success message
                    $passmsg = '<div class = "alert alert-success col-sm-6 ml-5 mt-2" role = "alert">Updated Successfully</div>';
                } else {
                    // Display error message
                    $passmsg = '<div class = "alert alert-danger col-sm-6 ml-5 mt-2" role = "alert">Unable to Update</div>';
                }
            }
        }
    }
}
?>

<div class="col-sm-6 mt-5 " style="background: lightgray; margin-left: 200px;">
    <h3 style="text-align: center;margin-top: 25px;font-size: 45px;font-weight: 700;font-family:Playfair Display" class="text-center">Change Password</h3>
    <div class="row">
        <div class="col-sm-6" style="margin-left: 200px;">
            <form class="mt-5 mb-5">
                <div class="form-group" style="font-size: 20px;font-family: nunito ui-sans-serif;font-weight: bold;">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="inputEmail" value=" <?php echo $adminEmail ?>" readonly>
                </div>
                <div class="form-group" style="font-size: 20px;font-family: nunito ui-sans-serif;font-weight: bold;">
                    <label for="inputnewpassword">New Password</label>
                    <input type="password" class="form-control" style= "margin-bottom:20px;margin-top: 20px;" id="inputnewpassword" placeholder="New Password" name="adminPass">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" style="width: 30%;border-radius: 25px;margin-left:20px;margin-top: 30px; margin-bottom:25px" name="adminPassUpdatebtn"> Update </button>
                <button type="reset" style="width: 30%;border-radius: 34px;margin-right: 12px;" class="btn btn-secondary"> Reset </button>
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
            </form>
        </div>
    </div>
</div>

<?php
include('./adminInclude/footer.php');
?>