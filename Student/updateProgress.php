<?php
// Include the database connection file
include_once('../dbConnection.php');

// Check if the required parameters are received via GET request
if(isset($_GET['lesson_id']) && isset($_GET['course_id']) && isset($_GET['stu_email']) && isset($_GET['stu_id'])) {
    // Retrieve lesson ID, course ID, student email, and student ID from the GET parameters
    $lessonId = $_GET['lesson_id'];
    $courseId = $_GET['course_id'];
    $stuEmail = $_GET['stu_email'];
    $stuId = $_GET['stu_id'];

    // Get the current date and time for the 'completed_at' field
    $completedAt = date('Y-m-d H:i:s');

    // Insert a new record into the 'progress' table
    $sql = "INSERT INTO progress (lesson_id, course_id, stu_id, completed_at) VALUES ('$lessonId', '$courseId', '$stuId', '$completedAt')";
    
    if ($conn->query($sql) === TRUE) {
        // If the insertion is successful, send a success response
        echo "Progress updated successfully";
    } else {
        // If there's an error with the SQL query, send an error response
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If any of the required parameters are missing, send an error response
    echo "Error: Required parameters are missing";
}

// Close the database connection
$conn->close();
?>