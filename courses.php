<?php

include('./dbConnection.php');
include('./mainInclude/header.php');
?>
<body >
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<!--Start of course banner---->
<div class="container-fluid bg-dark">
  <div class="row">
    <!--<img src="./images/p5.png" alt="courses" style="height:500px; width:110%;  object-fit:cover; box-shadow:10px;" />-->
    <!--<h2 style="position: absolute;
    color: #000;
    top: 25%;
    font-family:playfair display;
    text-align: center;
    font-weight:700;
    font-size: 60px;">Our Courses </h2>-->
  </div>
</div>

<!--course banner Space---->


<br><br><br>
<h1 class="text-center" style="font-family: Playfair Display;font-size: 50px;font-weight: 700;text-align: center;margin-top: 30px;">Our Courses </h1>

<!-- Start of sort button -->
<div class="container mt-3 mb-3">
    <div class="row justify-content-end">
        <div class="col-auto">
            <button id="sortLowToHigh" class="btn btn-primary">Sort by Price Low to High</button>
        </div>
        <div class="col-auto">
            <button id="sortHighToLow" class="btn btn-primary">Sort by Price High to Low</button>
        </div>
    </div>
</div>
<hr>
<!-- End of sort button -->

<!--Start-->

<div class="container mt-5 mb-5">
  <div class="row">
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
        echo '
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <a href="coursedetail.php?course_id='.urlencode($course_id).'" class="btn" style="text-align: left; padding: 0px; display: contents;">
            <div class ="card w-100 h-100">
              <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="HTML" style="width: 100%; height:250px; object-fit: cover;" />
              <div class="card-body">
                <h5 class="card-title">' . $row['course_name'] . '</h5>
                <p class="card-text">' . $row['course_desc'] . '</p>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <p class= "card-text d-inline">
                Price: 
                <small><del> &#8377 ' . $row['course_original_price'] . ' </del> </small> 
                <span class="font-weight-bolder">&#8377 ' . $row['course_price'] . ' </span> 
                </p>
                <a class= "btn text-white font-weight-bolder float-right " style="background: #fd917e;border-radius: 22px;font-size: 16px;" href ="coursedetail.php?course_id=' . urlencode($course_id) . '"> 
                  Enroll Now
                </a>
              </div>
            </div>
          </a>
        </div>';
      }
    }
    ?>
  </div>
</div>

<!-- JavaScript for sorting -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("sortLowToHigh").addEventListener("click", function() {
        sortCourses('lowToHigh');
    });
    
    document.getElementById("sortHighToLow").addEventListener("click", function() {
        sortCourses('highToLow');
    });
});

function sortCourses(order) {
    var url = "sortCourses.php?order=" + order;
    window.location.href = url;
}
</script>

<script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
<!-- End of JavaScript for sorting -->


  </body>
<!--Endd-->

<!-- Start include Footer -->
<?php
include('./mainInclude/footer.php');
?>
<!--End include Footer-->