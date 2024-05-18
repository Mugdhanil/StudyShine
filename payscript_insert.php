<?php
if (!isset($_SESSION)) {
    session_start();
}

$apiKey = "rzp_test_4fdfSU1OCN3pbQ";
include('./dbConnection.php');

if (!isset($_SESSION['stuLogEmail'])) {
    echo "<script>alert('Kindly Sign in first to Buy the Course. Thanks.');</script>";
    echo "<script>location.href='index.php'</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
   
    $p_date = date("Y-m-d H:i:s"); // Get current date and time
    $stu_name = $_POST['stu_name'];
    $stu_email = $_POST['stu_email'];
    $course_id = $_POST['course_id'];
    $course_price = $_POST['course_price'];

    // Insert payment details into the payment table
    $sql_insert_payment = "INSERT INTO payment (p_date, stu_name, stu_email, course_id, course_price) VALUES ('$p_date', '$stu_name', '$stu_email', '$course_id', '$course_price')";

    // Execute the SQL query
    if ($conn->query($sql_insert_payment) === TRUE) {
        // Payment inserted successfully
        // Redirect user to myCourse.php or any other page
        echo "<script>location.href='Student/myCourse.php'</script>";
    } else {
        // If there's an error in SQL execution
        echo "Error: " . $sql_insert_payment . "<br>" . $conn->error;
    }
} else {
    // If someone tries to access this page directly without POST data, handle it accordingly
    echo "Invalid request";
}

$conn->close();
?>