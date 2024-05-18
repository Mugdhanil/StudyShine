
<!DOCTYPE html>
<html lang="en">

<head>

<style>
    /* Add your CSS styles here */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      ;
    }

    h1 {
      margin-top: 5rem;
      text-align: center;
    }

    /* This class is defining the styling for a grid container. */
    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    /* This class is defining the styling for the container element that holds each testimonial in a testimonial grid. */
    .testimonial-container {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       /* Light blue background color */
    }

    /* This class is defining the styling for the avatar image */
    .testimonial-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 20px;
    }

    .testimonial-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .testimonial-text {
      margin-bottom: 20px;
    }

    .testimonial-name {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
      color: #333333;
    }

    .testimonial-role {
      font-size: 16px;
      color: #666666;
    }

    body {
      background: #B9D9EB;
    }

    /* This media query in CSS that targets screens with a maximum width of 600 pixels. */
    @media screen and (max-width: 600px) {
      .testimonial-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
  
</head>

<body style="background-color: #B9D9EB;">
<?php

include('./dbConnection.php');
include('./mainInclude/header.php');

$sql = "SELECT s.stu_img, s.stu_name, f.f_content FROM student s INNER JOIN feedback f ON s.stu_id = f.stu_id";
$result = $conn->query($sql);
?>
  <br>
  <h1 style="color:#000;    text-align: center;margin-top:100px;"> From the StudyShine community</h1>
  <br>
  <h5 style="color:#000;    text-align: center;margin-bottom:40px;"> 10K+ people have already joined StudyShine</h5>
  <div class="testimonial-grid">

    <?php
    // Check if there are testimonials in the database
    if ($result->num_rows > 0) {
      // Loop through each testimonial
      while ($row = $result->fetch_assoc()) {
        $s_img = $row['stu_img'];
        $n_img = str_replace('..', '.', $s_img)
    ?>
        <div class="testimonial-container">
          <div class="testimonial-avatar">
            <img src="<?php echo $n_img ?>" alt="User Avatar">
          </div>
          <div class="testimonial-text">
            <p class="testimonial-name"><?php echo $row['stu_name']; ?></p>
            <p><?php echo $row['f_content']; ?></p>
          </div>
        </div>
    <?php
      }
    } else {
      // Display a message if no testimonials are found
      echo "<p>No testimonials available.</p>";
    }
    ?>
  </div>
  <!--End of Contact Us-->

  <div class="container-fluid bg-danger"> <!-- Start Social Follow-->
    <div class="row text-white text-center p-1" style="margin-top: 50px; background: #002244; background-color: #002244; font-size: 20px; font-family: nunito sans;">

      <div class="col-sm">
        <a style="text-decoration: none;" class="text-white social-hover" href="https://www.facebook.com"><i class="fab fa-facebook-f"></i> Facebook</a>
      </div>

      <div class="col-sm">
        <a style="text-decoration: none;" class="text-white social-hover" href="https://www.twitter.com"><i class="fab fa-twitter"></i> X</a>
      </div>

      <div class="col-sm">
        <a style="text-decoration: none;" class="text-white social-hover" href="https://www.whatsapp.com"><i class="fab fa-whatsapp"></i> Whatsapp </a>
      </div>

      <div class="col-sm">
        <a style="text-decoration: none;" class="text-white social-hover" href="https://www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
    </div>
  </div>
  <!-- End Social Follow -->

  <!-- Start About Section -->
  <div class="container-fluid p-4" style="background-color: #E9ECEF">
    <div class="container" style="background-color: #E9ECEF">
      <div class="row text-center">

        <div class="col-sm">
          <h5 style="font-family: Playfair Display;font-size: 25px;font-weight: bold;">About Us</h5>
          <p style="font-size: 20px;font-family: nunito sans-serif;">StudyShine provides universal access to the world's best
            education, partnering with top universities and
            organizations to offer courses online.</p>
        </div>

        <div class="col-sm">
          <h5 style="font-family: Playfair Display;font-size: 25px;font-weight: bold;">Category</h5>
          <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Development</a> <br />
          <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Design</a> <br />
          <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">IT and Software</a> <br />
          <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Business</a> <br />
          <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Marketing</a> <br />
        </div>

        <div class="col-sm">
          <h5 style="font-family: Playfair Display;font-size: 25px;font-weight: bold;">Contact us</h5>
          <p style="font-size: 20px;font-family: nunito sans-serif;">StudyShine Pvt Ltd <br> Near Rupali Neher <br> Bhatar,
            Surat <br> Ph. 9835725173 </p>
        </div>

      </div>
    </div>
  </div> <!-- End About Section -->

</body>

</html>
<?php
include('./mainInclude/footer.php');
?>