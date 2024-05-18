<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check if certificate ID is provided via GET request
if(isset($_GET['id'])) {
    // Sanitize and validate the ID
    $certificateId = $_GET['id'];
    if(!filter_var($certificateId, FILTER_VALIDATE_INT)) {
        echo "Invalid certificate ID";
        exit;
    }

    // Include database connection
    include_once('../dbConnection.php');

    // Prepare SQL query to delete certificate
    $sql = "DELETE FROM certificates WHERE id = $certificateId";

    // Execute the deletion query
    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Certificate deleted successfully";
    } else {
        // Error in deletion
        echo "Error deleting certificate: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // If certificate ID is not provided in the request
    echo "Certificate ID not provided";
}
?>