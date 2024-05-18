<?php
// Include necessary files
include('./dbConnection.php');
include('./mainInclude/header.php');

// Start the session
session_start();

// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as BaseException;
use PHPMailer\PHPMailer\SMTP;

require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');

// Check if course ID is set in session
if (!isset($_SESSION['course_id'])) {
    header('Location: courses.php');
    exit;
}

$email = "";
$stuName = ""; // Initialize $stuName variable

if (isset($_SESSION['is_login']) && isset($_SESSION['stuLogEmail'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
    // Fetch email address from session
    $email = $stuEmail;

    // Fetch student's name from the database based on the email
    $sql = "SELECT stu_name FROM student WHERE stu_email = '$stuEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stuName = $row['stu_name']; // Assign the fetched name to $stuName
    } else {
        // Handle the case where student's name is not found
        echo "<script>alert('Failed to fetch student's name from the database.');</script>";
        exit;
    }
} else {
    // Handle the case where email is not found in the session
    echo "<script>alert('Failed to fetch email address from session.');</script>";
    exit;
}


// Generate and send Payment OTP when the page loads
$payment_otp = rand(100000, 999999);
$mail = new PHPMailer(true); // Generate Payment OTP

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'studyshine14@gmail.com';
    $mail->Password   = 'szgulcxkzqzcykbc';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('studyshine14@gmail.com', 'StudyShine');
    $mail->addAddress($email);     // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'StudyShine - Payment';
    $mail->Body    = "Hello $stuName,<br><br>Your One Time Password (OTP) for StudyShine Payment is: <strong>$payment_otp</strong>.<br><br>Please use this OTP to complete your payment.<br><br>Thank you.";

    $mail->send();

    // Store Payment OTP in session
    $_SESSION['payment_otp'] = $payment_otp;
    echo "<script>alert('OTP Sent to your Email. Kindly Check and Confirm.');</script>";
} catch (Exception $e) {
    echo "<script>alert('Failed to send OTP. Please try again. Error: " . $e->getMessage() . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
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
    <!-- Add your HTML content here -->
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
                                    <h3 class="text-uppercase border-bottom">Verify Payment OTP</h3>
                                    <p class="text-muted small mb-5">Please Enter Payment OTP sent on your Email address</p>
                                    <form action="./verify_pay.php" method="post">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="payment_otp" id="payment_otp" placeholder="One Time Password" maxlength="6">
                                        <label for="floatingInput">Enter One Time Password</label>
                                    </div>
                                    <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="verify_payment_otp">Verify OTP</button>
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
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Include footer
include('./mainInclude/footer.php');
?>