<!DOCTYPE html>
<html Lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Dashboard</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="../css/all.min.css">

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">

<!--Custom CSS-->
<link rel = "stylesheet" href="../css/adminstyle.css">

</head>
<body>
    <!-- Top Navbar -->
<nav class="navbar navbar-dark fixed-top p-0 shadow" style= "background-color: #225470;">
<a class= "navbar-brand col-sm-3 col-md-2 mr-0" href= "admindashboard.php" style = "margin-left:15px;">StudyShine 
<small class= "text-white">Admin Area</small></a>
</nav>

<!-- Side Bar -->
<div class="container-fluid mb-5" style= "margin-top: 40px;">
<div class="row">
<nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href= "admindashboard.php">
                <i class="fa-solid fa-gauge-high"></i>
                    Dashboard
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "coursead.php">
                <i class="far fa-list-alt"></i>
                 Courses
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "lessons.php">
                <i class="fa-solid fa-person-chalkboard"></i>
                   Lessons
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "students.php">
                    <i class="fas fa-users"></i>
                   Students
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "sellreport.php">
                    <i class="fas fa-table"></i>
                   Sell Report
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "feedback.php">
                    <i class="fa-solid fa-comment-dots"></i>
                   Feedback
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "adminChangePass.php">
                    <i class="fas fa-key"></i>
                   Change Password
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "queries.php">
                <i class="fa-solid fa-person-circle-question"></i>
                   Queries
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href= "../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

  