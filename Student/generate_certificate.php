<?php
// Initialize variables
$courseId = "";
$courseName = "";
$stuId = "";
$stuEmail = "";

// Check if the session is set
if (!isset($_SESSION)) {
    session_start();
}

// Include the database connection file
include_once('../dbConnection.php');

// Check if the user is logged in
if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
    $sql_student_id = "SELECT stu_id FROM student WHERE stu_email = '$stuEmail'";
    $result_student_id = $conn->query($sql_student_id);
    if ($result_student_id->num_rows > 0) {
        $row_student_id = $result_student_id->fetch_assoc();
        $stuId = $row_student_id['stu_id'];
    } else {
        echo "Error";
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Check if the course ID is passed from the previous page
if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];
}

// Retrieve the course name from the database using the course ID
$sql_course_name = "SELECT course_name FROM course WHERE course_id = '$courseId'";
$result_course_name = $conn->query($sql_course_name);
if ($result_course_name->num_rows > 0) {
    $row_course_name = $result_course_name->fetch_assoc();
    $courseName = $row_course_name['course_name'];
}

// Retrieve the student's name from the database using the student ID
$sql_student_name = "SELECT stu_name FROM student WHERE stu_id = '$stuId'";
$result_student_name = $conn->query($sql_student_name);
if ($result_student_name->num_rows > 0) {
    $row_student_name = $result_student_name->fetch_assoc();
    $stuName = $row_student_name['stu_name'];
}

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Certificate of Completion - StudyShine');
$pdf->SetSubject('Course Completion Certificate - StudyShine');
$pdf->SetKeywords('Certificate, PDF, Completion');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add background color and stripe designs
$pdf->SetFillColor(255, 255, 255); // Background color (white)
$pdf->Rect(0, 0, 210, 297, 'F'); // Full page rectangle

// Add blue stripe design
$pdf->SetFillColor(0, 102, 204); // Blue color
$pdf->Rect(0, 0, 210, 30, 'F'); // Blue stripe rectangle

// Add orange stripe design
$pdf->SetFillColor(255, 153, 51); // Orange color
$pdf->Rect(0, 267, 210, 30, 'F'); // Orange stripe rectangle

// Add course name to the content
$content = '
    <div style="text-align: center; font-size: 24pt; font-weight: bold; color: #ffffff; margin-top: 40pt;">StudyShine - Lifetime Knowledge</div>
    <br><br><br>
    <div style="text-align: center; font-size: 24pt; font-weight: bold; color: #333333; margin-top: 20pt;">Certificate of Completion</div>
    <hr>
    <div style="text-align: center; font-size: 18pt; color: #666666; margin-top: 10pt;">"Education is the passport to the future, for tomorrow belongs to those who prepare for it today." - Malcolm X</div>
    <div style="text-align: center; font-size: 16pt; color: #333333; margin-top: 20pt;">This is to certify that</div>
    <div style="text-align: center; font-size: 20pt; font-weight: bold; color: #333333; margin-top: 20pt;">' . $stuName . '</div>
    <div style="text-align: center; font-size: 16pt; color: #333333; margin-top: 20pt;">(' . $stuEmail . ')</div>
    <div style="text-align: center; font-size: 16pt; color: #333333; margin-top: 20pt;">has successfully completed the course:</div>
    <div style="text-align: center; font-size: 24pt; font-weight: bold; color: #333333; margin-top: 20pt;">' . $courseName . '</div>
    <div style="text-align: center; font-size: 16pt; color: #333333; margin-top: 20pt;">Date: ' . date('Y-m-d') . '</div>
    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <div style="text-align: center; font-size: 18pt; color: #666666; margin-top: 40pt;">StudyShine - Lifetime Knowledge</div>
';

// Add content to the PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Close and output PDF document
$certificateFileName = 'StudyShine_Course_Certificate_' . date('dmYhi') . '.pdf'; // Change the filename here
$pdf->Output($certificateFileName, 'D');

// Insert certificate details into the database
$insertSql = "INSERT INTO certificates (name, course_id, stu_id, certificate_link) VALUES ('$stuName', '$courseId', '$stuId', '$certificateFileName')";
if ($conn->query($insertSql) === TRUE) {
    echo "Certificate generated successfully!";
} else {
    echo "Error: " . $insertSql . "<br>" . $conn->error;
}

$conn->close(); // Close the database connection
exit; // Terminate script execution after generating PDF
?>