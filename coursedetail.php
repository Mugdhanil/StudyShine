<!--Start of header-->
<?php
include('./dbConnection.php');
include('./mainInclude/header.php');

?>

<?php
$alreadyEnrolled = false; // Initialize the variable


if (isset($_SESSION['stuLogEmail'])) {
  // Retrieve student's email and course ID
  $stuEmail = $_SESSION['stuLogEmail'];
  $course_id = $_GET['course_id'];
  $_SESSION['course_id'] = $course_id;

  // Check if the student has already enrolled in the course
  $sql_payment = "SELECT * FROM payment WHERE stu_email = '$stuEmail' AND course_id = '$course_id'";
  $result_payment = $conn->query($sql_payment);
  $alreadyEnrolled = ($result_payment->num_rows > 0);

  // Fetch course details
  $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
}
?>

<!-- Start of course banner -->
<style>
  .courses-tag {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #000;
    font-family: playfair display;
    font-weight: 700;
    font-size: 60px;
    z-index: 1;
    /* Ensure the tag appears above the images */
  }

  .carousel-inner {
    width: 100%;
    /* Ensure full width */
    display: flex;
    /* Use flexbox layout */
    overflow: hidden;
    /* Hide overflow to remove extra space */
  }

  .carousel-item {
    min-width: 100%;
    /* Ensure each item takes full width */
    transition: transform 0.6s ease;
    /* Ensure smooth transition */
  }

  .carousel-item img {
    width: 100%;
    /* Ensure images take full width */
    height: auto;
    /* Maintain aspect ratio */
  }

  .carousel:hover .carousel-item {
    pointer-events: none;
    /* Prevent hover effect from pausing the animation */
  }
  .bg-dark {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;

}
.text-center {
    text-align: center !important;
}
.p-2 {
    padding: .5rem !important;
}
footer {
    display: block;
    unicode-bidi: isolate;
}
.text-white {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}

</style>

<!-- Start of course banner -->
<div class="container-fluid bg-dark">
  <div class="row">
    <!-- Image Slider -->
    <div id="imageSlider" class="carousel slide" data-ride="carousel" data-interval="3000">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <!-- First Slide -->
        <div class="carousel-item active">
          <img src="./images/Course.png" class="d-block w-100" style="height: 570px; object-fit: cover;" alt="courses">
        </div>
        <!-- Add additional slides here -->
        <div class="carousel-item">
          <img src="./images/Course2.png" class="d-block w-100" style="height: 570px; object-fit: cover;" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img src="./images/Course3.png" class="d-block w-100" style="height: 570px; object-fit: cover;" alt="Third slide">
        </div>
        <div class="carousel-item">
          <img src="./images/Course4.png" class="d-block w-100" style="height: 570px; object-fit: cover;" alt="Fourth slide">
        </div>
      </div>
      <!-- Navigation arrows -->
      <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
<!-- End of course banner -->

<!--Start of Main Content-->
<div class="container mt-5">
  <?php

  if (isset($_GET['course_id'])) {

    $course_id = $_GET['course_id'];
    $_SESSION['course_id'] = $course_id;
    $sql = "SELECT *FROM course WHERE course_id = '$course_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }

  ?>

  <div class="row">

    <div class="col-md-4">

      <img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" class="card-img-top" alt="Course image" style="    width: 120%;
    margin-left: -77px; margin-top:30px;" />

    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title" style="font-size:30px;">Course Name: <?php echo $row['course_name'] ?> </h5> <br>

        <p class="card-text" style="font-size:18px; font-weight:400;"> <strong>Description:</strong> <?php echo $row['course_desc'] ?></p>
        <p class="card-text" style="font-size:18px; font-weight:400;"><strong> Duration: </strong><?php echo $row['course_duration'] ?> Hours </p>

        <form action="checkout.php" method="post">

          <p class="card-text d-inline" style="font-size:18px; font-weight:500 ;">Price: <small><del>&#8377 <?php echo $row['course_original_price'] ?></del></small>
            <span class="font-weight-bolder">&#8377 <?php echo $row['course_price'] ?><span>
          </p>
          <input type="hidden" name="id" value=" '$row['course_price']'"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <?php if (!$alreadyEnrolled) : ?>
           <div> <a class="btn text-white font-weight-bolder float-right" style="background: #fd917e; border-radius: 22px; display: inline; font-size: 16px; margin-left: 27px;f" href="checkout.php?course_id=<?php echo $course_id; ?>"> Buy Now with Card</a></div> 
           <div>  <a class="btn text-white font-weight-bolder float-right" style="background: #fd917e; border-radius: 22px; display: inline; font-size: 16px;" href="payscript.php?course_id=<?php echo $course_id; ?>"> Buy Now with RazorPay</a></div>
          <?php else : ?>
            <div class="text-success float-right">
              <p class='text-success d-inline-block'>You have already enrolled in this course.</p>
              <a class="btn text-white font-weight-bolder float-right" style="background: #fd917e;border-radius: 22px;display: inline;font-size: 16px; margin-left:400px;" href="./Student/myCourse.php"> Go To My Courses </a>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
  <br>

  <div class="container">
    <div class="row">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col"> Lesson No. </th>
            <th scope="col"> Lesson Name </th>
            <th scope="col"> Lesson Description </th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT *FROM lesson";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $num = 0;

            while ($row = $result->fetch_assoc()) {
              if ($course_id == $row['course_id']) {
                $num++;
                echo '<tr>
                <th scope= "row">' . $num . '</th>
                <td> ' . $row['lesson_name'] . '</td>
                <td> ' . $row['lesson_desc'] . '</td>
            </tr>';
              }
            }
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>

</div>
</div>


<!--End of Main Content-->

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JavaScript and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php

include('./mainInclude/footer.php');
?>


<!-- Start Footer -->



<!-- End of Footer-->