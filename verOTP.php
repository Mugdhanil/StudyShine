<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
if(!isset($_SESSION['forgotPasswordEmail'])) {
    echo "<script>alert('Error encountered while sending the OTP to your Email. Please try again later!');</script>";
    header('Location: index.php');
}
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<title>Verify OTP</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="vh-100 bg-light d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="/elearning/images/p4.png" alt="LOGIN photo" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form id="resetpass" method="POST" action="Password_reset.php"> <!-- Changed action to passwordReset.php -->
                                        <h5 class="fw-normal mb-3 pb-3 text-center">OTP Verification || Forgot Password</h5>
                                        <p class="text-center text-muted small pb-3 mb-3">Kindly Enter One Time Password which is sent on your Email Address</p>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="Verotp" id="floatingInput" placeholder="One Time Password" maxlength="6">
                                            <label for="floatingInput">Enter One Time Password</label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" name="verify" type="submit">Verify</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>