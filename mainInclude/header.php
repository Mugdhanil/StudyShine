  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale= 1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap CSS-->
    <link rel="stylesheet" href="css/all.min.css"> <!-- font awesome  CSS-->
    <!--Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">

    <!--Custom CSS -->
    <link rel="stylesheet" href="css/style.css">


    <title>StudyShine</title>
  </head>

  <body>
    <!-- Starting Navigation BAr-->
    <nav class="navbar navbar-expand-sm navbar-dark px-5 fixed-top" style="
  background-color: #002244;">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php" style="font-family:Titillium Web;">
      <img src="images/SS_logo1.png" alt="StudyShine Logo" height="70">
      StudyShine
    </a>
    <span class="navbar-text"> Lifetime Knowledge </span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav custom-nav px-5 ">
        <li class="nav-item custom-nav-item ">
          <a class="nav-link" style=" font-family: Nunito-sans;
  font-size: 20px;
  font-weight: 100;" href="index.php">Home</a>
        </li>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" style=" font-family: Nunito-sans;
  font-size: 20px;
  font-weight: 100;" href="courses.php">Courses</a>
        </li>

        <?php
        session_start();
        if (isset($_SESSION['is_login'])) {
          echo '<li class="nav-item custom-nav-item">
        <a href= "student/studentProfile.php" class="nav-link" style=" font-family: Nunito-sans;
        font-size: 20px;
        ">My Profile</a>
      </li>
      <li class="nav-item custom-nav-item">
        <a href="logout.php" style=" font-family: Nunito-sans;
        font-size: 20px;" class="nav-link">Logout</a>
      </li>';
        } else {
          echo '<li class="nav-item custom-nav-item">
        <a href="# " class="nav-link" style=" font-family: Nunito-sans;
        font-size: 20px;" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter">Sign In</a>
      </li>
      <li class="nav-item custom-nav-item">
        <a href=" #" class="nav-link" style=" font-family: Nunito-sans;
        font-size: 20px;
        font-weight: 100;" data-bs-toggle="modal" data-bs-target="#stuRegModalCenter">Sign Up</a>
      </li>';
        }
        ?>

        <li class="nav-item custom-nav-item">
          <a href="testimonialslider.php" style=" font-family: Nunito-sans;
  font-size: 20px;
  font-weight: 100;" class="nav-link">Feedback</a>
        </li>
        <li class="nav-item custom-nav-item">
          <a href="contactus.php" style=" font-family: Nunito-sans;
  font-size: 20px;
  font-weight: 100;" class="nav-link">Contact Us</a>
        </li>

      </ul>

    </div>

  </div>
</nav>