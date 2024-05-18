<?php
session_start();

// Include necessary files
include('./dbConnection.php'); // Adjust the path as per your file structure
include('./mainInclude/header.php'); // Adjust the path as per your file structure

// Check if form is submitted for OTP verification
if (isset($_POST['verify_payment_otp'])) {
    // Retrieve stored OTP from session
    $stored_otp = $_SESSION['payment_otp'];

    // Retrieve entered OTP from the form
    $entered_payment_otp = $_POST['payment_otp'];

    if ($entered_payment_otp == $stored_otp) {
        // OTP verified successfully
        // Proceed with inserting payment details into the database
        if (isset($_SESSION['stuLogEmail'], $_SESSION['course_id'])) {
            $stuEmail = $_SESSION['stuLogEmail'];
            $course_id = $_SESSION['course_id'];

            // Fetch course details including price from the database
            $sql_course = "SELECT course_name, course_price FROM course WHERE course_id = '$course_id'";
            $result_course = $conn->query($sql_course);

            if ($result_course && $result_course->num_rows > 0) {
                $row_course = $result_course->fetch_assoc();
                $course_name = $row_course['course_name'];
                $course_price = $row_course['course_price'];

                // Fetch student details from the database
                $sql_stu = "SELECT stu_name FROM student WHERE stu_email = '$stuEmail'";
                $result_stu = $conn->query($sql_stu);

                if ($result_stu && $result_stu->num_rows > 0) {
                    $row_stu = $result_stu->fetch_assoc();
                    $stuName = $row_stu['stu_name'];

                    // Insert payment details into the database
                    $p_date = date("Y-m-d");
                    $sql_insert = "INSERT INTO payment (stu_name, stu_email, course_id, course_price, p_date) VALUES ('$stuName', '$stuEmail', '$course_id', '$course_price', '$p_date')";
                    $result_insert = $conn->query($sql_insert);

                    if ($result_insert) {
                        // Set session variables for the next page
                        $_SESSION['stuName'] = $stuName;
                        $_SESSION['course_name'] = $course_name; // Assuming you have fetched course name
                        $_SESSION['course_price'] = $course_price;
                        $_SESSION['p_date'] = $p_date;

                        // Redirect to responsee.php
                        header('Location: ./Student/responsee.php');
                        exit;
                    } else {
                        echo "<script>alert('Failed to insert payment details into the database.');</script>";
                    }
                } else {
                    echo "<script>alert('Failed to fetch student details.');</script>";
                }
            } else {
                echo "<script>alert('Failed to fetch course details.');</script>";
            }
        } else {
            echo "<script>alert('Student email or course ID not set.');</script>";
        }
    } else {
        // Invalid OTP, display error message
        echo "<script>alert('Invalid Payment OTP! Insert Correct OTP!');</script>";
        header('Location: ./paymentstatus.php');
    }
}
?>