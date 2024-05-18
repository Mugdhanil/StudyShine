<?php

include('./dbConnection.php');
include('./mainInclude/header.php');

session_start();
if(!isset($_SESSION['RegOTPChk']))
{
    header('Location : contactus.php');
}
?>
<head>
<style>
        /* Custom styles for this page */
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 4rem;
        }

        .form-floating input[type="text"] {
            border-radius: 10px;
            border: 1px solid #ced4da;
        }

        .form-floating label {
            color: #495057;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-primary:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
   
   
    <section class="vh-100 bg-light">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="/elearning/images/p3.png" alt="Sign Up photo" class="img-fluid card-img" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <h3 class="text-uppercase border-bottom">Sign up Verification</h3>
                                    <p class="text-muted small mb-5">Please Enter One time password which sent on your Email address</p>
                                    <form method="post">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="regotp" id="floatingInput" placeholder="One Time Password" maxlength="6">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['verify'])) {
    $regotp = $_POST['regotp'];
    if (empty($regotp)) {
        echo "<script>alert('Kindly insert OTP to Verify.');</script>";
    } elseif ($_SESSION['RegOTPChk'] == $regotp) {
        // Assuming you have sanitized your inputs to prevent SQL injection
        $name = $_SESSION['stuname'];
        $email = $_SESSION['stuemail'];
        $password = $_SESSION['stupass'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the student table
        $q = "INSERT INTO student (stu_name, stu_email, stu_pass) VALUES ('$name', '$email', '$hashed_password')";

        // Execute the query
        $r = mysqli_query($conn, $q);

        if ($r) {
            unset($_SESSION['RegOTPChk']);
            echo "<script>alert('OTP verified Successfully! Kindly Login with your New Email ID and Password to StudyShine Portal!');</script>";
      
            echo "<script>location.href='index.php'</script>";
        } else {
            echo "error";
        }
    } else {
        echo "<script>alert('Invalid OTP! Insert Correct OTP!');</script>";
    }
}
?>
<!-- Start include Footer -->
<?php
include('./mainInclude/footer.php');
?>
<!--End include Footer-->