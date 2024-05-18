<?php
session_start();

// Include necessary files
include('../dbConnection.php'); // Adjust the path as per your file structure
include('./stuInclude/header.php'); // Adjust the path as per your file structure

// Check if the user is logged in
if (isset($_SESSION['stuLogEmail'])) {
    // Fetch payment details associated with the student's email
    if (isset($_SESSION['stuName'], $_SESSION['course_name'], $_SESSION['course_price'], $_SESSION['p_date'])) {
        $stuName = $_SESSION['stuName'];
        $course_name = $_SESSION['course_name'];
        $course_price = $_SESSION['course_price'];
        $p_date = $_SESSION['p_date'];
    } else {
        echo "<script>alert('Payment details not set in session.');</script>";
    }
} else {
    echo "<script>alert('User not logged in.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Response Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */

    /* Custom button styles */
    .custom-btn {
      border-radius: 50px;
      font-size: 20px;
      font-family: 'Nunito Sans', sans-serif;
      padding: 10px 25px;
      margin-top: 20px;
    }

    .custom-btn-danger {
      background-color: #fd917e;
      border-color: #fd917e;
      color: #fff;
    }

    .custom-btn-danger:hover {
      background-color: #e86b4d;
      border-color: #e86b4d;
    }

    .custom-btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
    }

    .custom-btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    body{
      overflow:hidden;
    }
  </style>
</head>

<body>
  <!-- Add your HTML content here -->
  <div class="container">
  <div class="col-md-12 text-center">
   <p class="" style="font-family: Playfair Display; font-size: 40px; font-weight: 600;">Thank for your purchase</p>
  </div>
   <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
          <div class="card-header">
            Payment Details
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">Student Name: <?php echo $stuName ?? 'N/A'; ?></li>
              <li class="list-group-item">Course Name: <?php echo $course_name ?? 'N/A'; ?></li>
              <li class="list-group-item">Course Price: <?php echo $course_price ?? 'N/A'; ?></li>
              <li class="list-group-item">Payment Date: <?php echo $p_date ?? 'N/A'; ?></li>
            </ul>
            <div class="text-center mt-4">
              <!-- "Click here to start..." button -->
              <a class="btn custom-btn custom-btn-danger" href="myCourse.php">Click Here to Start Your Course</a>
            </div>
            <div class="text-center mt-3">
              <!-- "Print Payment Receipt" button -->
              <button class="btn custom-btn custom-btn-primary" onclick="window.print();">Print Payment Receipt</button>
            </div>

            <!-- <a href = "./responsee.php"
      Download = "test_image">
         <button type = "button" style="width: 15%;
    border-radius: 65px;
    height: 37px;
    background: green;
    color: white;
    border-color: green;
    "> Download </button>
      </a>-->
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <?php
  include('./stuInclude/footer.php');
  ?>

  <!-- font awesome JS-->
  <script type="text/javascript" src="js/all.min.js"></script>
</body>

</html>