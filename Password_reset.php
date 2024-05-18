<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['forgotPasswordEmail'])) {
    echo "<script>alert('Error encountered while sending the OTP to your Email. Please try again later!');</script>";
    header('Location: index.php');
}
else{

  echo "<script>alert('OTP Verification Complete. Proceed for the Reset of your Password.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100 bg-light">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="/elearning/images/p4.png" alt="Forgot Password photo" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form id="resetpass" method="POST" action="Password_reset_page.php">
                                        <h3 class="fw-normal text-center pb-3 mb-3">Reset Password</h3>
                                        <div class="form-floating col-12 mb-3">
                                            <input type="password" class="form-control" id="NewPass" name="newpass" placeholder="New Password" required>
                                            <label for="NewPass">New Password</label>
                                        </div>
                                        <div class="form-floating col-12 mb-3">
                                            <input type="password" class="form-control" id="ConfirmNewPass" name="confirmnewpass" placeholder="Confirm New Password" required>
                                            <label for="ConfirmNewPass">Confirm New Password</label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Reset Password" name="resetpass" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>