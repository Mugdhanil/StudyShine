<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once('../dbConnection.php');

// Admin Login Verification
if (!isset($_SESSION['is_admin_login'])) {
    if (isset($_POST['checkLogemail']) && isset($_POST['adminLogEmail']) && isset($_POST['adminLogPass'])) {
        $adminLogEmail = $_POST['adminLogEmail'];
        $adminLogPass = $_POST['adminLogPass'];

        // Retrieve hashed password from the database based on the provided email
        $sql = "SELECT admin_email, admin_pass FROM admin WHERE admin_email = '".$adminLogEmail."'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['admin_pass'];

            // Verify hashed password
            if (password_verify($adminLogPass, $hashed_password)) {
                $_SESSION['is_admin_login'] = true;
                $_SESSION['adminLogEmail'] = $adminLogEmail;
                echo json_encode(1); // Successful login
            } else {
                echo json_encode(0); // Incorrect password
            }
        } else {
            echo json_encode(0); // Email not found
        }
    }
}
?>