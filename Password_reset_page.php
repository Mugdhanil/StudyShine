<?php
include('./dbConnection.php');
include('./mainInclude/header.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['forgotPasswordEmail'])) {
    echo "<script>alert('Error encountered while sending the OTP to your Email. Please try again later!');</script>";
    header('Location: index.php');
} else {
    if (isset($_POST['resetpass'])) {
        // Retrieve and sanitize form data
        $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmnewpass']);
        
        // Check if passwords match
        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('Passwords do not match. Please try again.')</script>";
        } else {
            // Validate password format
            if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])(?=.*[a-zA-Z]).{8,}$/', $newPassword)) {
                echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.')</script>";
            } else {
                // Passwords match and format is valid, proceed with password reset
                $email = $_SESSION['forgotPasswordEmail'];
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
                
                // Update password in the database
                $query = "UPDATE student SET stu_pass = '$hashedPassword' WHERE stu_email = '$email'";
                $result = mysqli_query($conn, $query);
                
                if ($result) {
                    // Password reset successful
                    unset($_SESSION['forgotPasswordEmail']);
                    echo "<script>alert('Password Reset Complete. Kindly Sign in to your StudyShine Account with your New Password.')</script>";
                    echo "<script>location.href = '/elearning/index.php';</script>";
                    exit; // Exit to prevent further execution
                } else {
                    // Password reset failed
                    echo "<script>alert('Password Reset Failed. Please try again.')</script>";
                }
            }
        }
    }
}
?>