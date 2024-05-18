<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('./dbConnection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');

if (isset($_POST['sendOTP1'])) {
    $q = "SELECT * FROM student WHERE stu_email='$_POST[forgotPasswordEmail]'";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result)) {
        $_SESSION['reg'] = 'True';
        $email = $_POST['forgotPasswordEmail'];
        $_SESSION['forgotPasswordEmail'] = $email;
        $row = mysqli_fetch_assoc($result); // Fetching the row from the query result
        $studentName = $row['stu_name']; // Extracting the student name from the fetched row
        $otp = rand(100000, 999999);
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'studyshine14@gmail.com';
            $mail->Password   = 'szgulcxkzqzcykbc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom('studyshine14@gmail.com', 'StudyShine');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'StudyShine - Reset Password';
            $mail->Body    = "Dear $studentName,<br>To continue the process of resetting your password, here is the One Time Password (OTP) for verification: <strong><u>$otp</u></strong>";
            if ($mail->send()) {
                $_SESSION['verOTP'] = $otp;
                echo "<script>alert('OTP Sent to your Email. Kindly Check and Confirm.');</script>";
                echo "<script>location.href='verOTP.php'</script>";
                exit;
            } else {
                throw new Exception('Failed to send email');
            }
        } catch (Exception $e) {
            echo "<script>alert('Error: {$e->getMessage()}');</script>";
        }
    } else {
        echo "<script>alert('Email Address does not Exist in StudyShine Database.');</script>";
    }
}
?>