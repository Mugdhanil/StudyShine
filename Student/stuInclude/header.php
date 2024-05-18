<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../dbConnection.php');


if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
}
//else {
//echo "<script> location.href='../index.php'; </script>";
//}
if (isset($stuEmail)) {
    $sql = "SELECT * FROM student WHERE stu_email = '$stuEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stu_img = $row['stu_img'];
}
?>

<!DOCTYPE html>
<html Lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">

    <!--Custom CSS-->
    <link rel="stylesheet" href="../css/stustyle.css">

</head>

<body>
    <nav class="navbar navbar-dark fixed top flex-md-nowrap p-0 shadow" style="background-color: #005A9C;">

        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="studentProfile.php" style="margin-left:10px; font-family:Titillium Web">StudyShine</a>
        <a class="nav-link" style="color: #fff;font-family: Nunito-sans;
    font-size: 20px; margin-right:20px;
    font-weight: 200;" href="../index.php">Home</a>

    </nav>

    <!--Side bar-->
    <div class="container-fluid mb-5" style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3">
                            <img src="<?php echo $stu_img ?>" alt="studentimage" class="img-thumbnail rounded-circle">
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="studentProfile.php" style="    color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                                <i class="fas fa-user"></i>
                                Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="myCourse.php" style="color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                                <i class="fa-solid fa-book"></i>
                                My Courses
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="viewCertificates.php" style="    color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                              <i class="fa-solid fa-award"></i>
                                View My Certificates
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="stufeedback.php" style="    color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                                <i class="fa-regular fa-message"></i>
                                Feedback
                            </a>
                        </li>
                        <br>

                        <li class="nav-item">
                            <a class="nav-link" href="studentChangePass.php" style="    color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                                <i class="fas fa-key"></i>
                                Change Password
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php" style="    color: black;
    font-size: 19px;
    font-family: nunito-sans;">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>