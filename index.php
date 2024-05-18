<!--Start of Navigation Bar-->
<?php

include('./dbConnection.php');
include('./mainInclude/header.php');
error_reporting(E_ALL ^ E_WARNING);

?>
<!-- Ending Navigation BAr-->


<!-- Start Video background-->
<div class="container-fluid remove-vid-marg">
  <div class="vid-parent">
    <img src="images/pexels-olia-danilevich-5088017.jpg" style="height: 655px;object-fit: cover;width: 100%;">
    <div class="vid-overlay" style="background-color: #002244;"> </div>
  </div>

  <div class="position-absolute top-0 left-0 right-0 bottom-0 d-flex flex-column text-white justify-content-center align-items-center z-1 w-100" style="margin-top: -100px;">

    <p style="font-size: 22px; text-align: center;">Lifetime Knowledge</p>
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['is_login'])) {
      // Retrieve the student's name from the database
      $sql = "SELECT stu_name FROM student WHERE stu_email = '{$_SESSION['stuLogEmail']}'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stu_name = $row['stu_name'];
        echo '<h1 class="my-content navbar" style="font-family: Playfair Display;font-size: 70px;font-weight: 800; text-align: center;">Welcome, ' . $stu_name . '</h1>';
      } else {
        // If the student's name cannot be retrieved, display a generic message
        echo '<h1 class="my-content navbar" style="font-family: Playfair Display;font-size: 70px;font-weight: 800; text-align: center;">Welcome to StudyShine</h1>';
      }
    } else {
      // If the user is not logged in, display a generic message
      echo '<h1 class="my-content navbar" style="font-family: Playfair Display;font-size: 70px;font-weight: 800; text-align: center;">Welcome to StudyShine</h1>';
    }
    ?>
    <p style="font-size: 22px; text-align: center;">"People expect to be bored by eLearning- let’s show them it doesn’t have to be like that!” </p>
    <br> <br>
    <?php
    if (!isset($_SESSION['is_login'])) {
      echo '<a href="#" class="btn btn-danger px-4" data-bs-toggle="modal" style="background: #fd917e;
      width: auto;
      border-radius: 54px;
      border-color: #fd917e;
      font-size: 20px;
      font-family: Nunito sans-serif;
     
  } "data-bs-target="#stuRegModalCenter">
      Get Started</a>';
    } else {
      echo '<a href="Student/studentProfile.php" class="btn btn-primary px-4" style="background: #fd917e;
      width: auto;
      border-radius: 54px;
      border-color: #fd917e;
      font-size: 20px;
    
      font-family: Nunito sans-serif;
  }">My Profile</a>';
    }
    ?>
  </div>
</div>

<!-- Ending Video background---->
<!-- pic with caption and all -->
<section>
  <div class="container pt-5">
    <div class="row d-flex align-items-center">
      <div class="imgtwo col-12 col-lg-6 position-relative">
        <div class="back-img"></div>
        <video playsinline autoplay muted loop>
          <source src="videos/bgvid.mp4">
        </video>
      </div>
      <div class="col-12 col-lg-6">
        <p style="font-size: 21px; color: #002244;" class="text-uppercase">Lifetime Knowledge</p>
        <h1 class="text-uppercase" style="color:#000;font-family: Playfair Display;">studyshine</h1>
        <p style="color: black; font-size: 18px; line-height: 30px; letter-spacing: 1px;">“It’s time to step up to the plate and get passionate about your work commit to making eLearning courses that don't bore people to tears, but instead inspire and motivate them to learn a new skill, change a certain behavior, or improve their performance.”</p>
      </div>
    </div>
  </div>
</section>

<!-- Start Most Popular Course---->
<div class="container mt-5">
  <h1 class="text-center" style="font-family: Playfair Display;font-size: 50px;font-weight: 700;text-align: center;margin-top: 30px;">Popular Courses </h1>
  <div class="row mt-4">
    <?php
    $sql = "SELECT *FROM course LIMIT 3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
        echo ' 
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <a href= "coursedetail.php?course_id=' . urlencode($course_id) . '" class = "btn" style="text-align: left; padding: 0px; display: contents;">
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
                <a class= "btn text-white font-weight-bolder float-right" style="background: #fd917e;border-radius: 22px;font-size: 16px;" href ="coursedetail.php?course_id=' . $course_id . '"> 
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
  <br>
  <br>
  <div class="text-center m-2">
    <a class="btn btn-danger btm-sm" style="background: #fd917e;
      border-radius: 50px;
      border-color: #fd917e;
      font-size: 20px; 
      font-family: Nunito sans-serif;" href="courses.php"> View All Courses </a>
  </div>
</div>

<!-- Starting Text banner---->
<link rel="stylesheet" href="../css/textbanner.css">
<div class="main text-center mt-5">
  <h2 class="heading" style="font-family: Playfair Display;font-size: 40px;font-weight: 600;text-align: center;margin-top: 50px;">An immersive learning experience</h2>

</div>

<div class="container mt-4 d-flex justify-content-center">

  <div class="row g-0">

    <div class="col-md-3 border-right">
      <div class="cards">


        <div class="first bg-white p-4 text-center">
          <img src="https://www.simplilearn.com/ice9/assets/home/v1.gif?w=50&dpr=1.3" />

          <h5>Develop skills for real career growth</h5>
          <p class="line1">Cutting-edge curriculum designed in guidance with industry and academia to develop job-ready skills</p>

        </div>

      </div>

    </div>



    <div class="col-md-3 border-right">
      <div class="cards">
        <div class=" second bg-white p-4 text-center">
          <img src="https://www.simplilearn.com/ice9/assets/home/v2.gif?w=50&dpr=1.3" />

          <h5>Learn from experts active in their field, not out-of-touch trainers</h5>
          <p class="line2">Leading practitioners who bring current best practices and case studies to sessions that fit into your work schedule.</p>

        </div>
      </div>

    </div>




    <div class="col-md-3">

      <div class="cards">
        <div class=" third bg-white p-4 text-center">
          <img src="https://www.simplilearn.com/ice9/assets/home/v3.gif?w=50&dpr=1.3" />
          <h5>Learn by working on real-world problems</h5>
          <p class="line3">Capstone projects involving real world data sets with virtual labs for hands-on learning</p>
        </div>
      </div>



    </div>
    <div class="col-md-3">

      <div class="cards">
        <div class=" third bg-white p-4 text-center">
          <img src="https://www.simplilearn.com/ice9/assets/home/v4.gif?w=50&dpr=1.3" />
          <h5>Structured guidance ensuring learning never stops</h5>
          <p class="line3">24x7 Learning support from mentors and a community of like-minded peers to resolve any conceptual doubts</p>
        </div>
      </div>



    </div>

  </div>

</div>
<!-- Ending Text Banner---->


<!-- Companies-->
<h3 style="font-family: Playfair Display; font-size: 40px; font-weight: 600; text-align: center; margin-top: 25px;">Trusted by over 13,400 great teams</h3>
<div class="marquee">
  <div class="marquee-content">
    <span class="item-collection-1">
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.microsoft.com"><img src="images/microsoft.png" height="80"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.amazon.com"><img src="images/Companies/amazon.png" height="30" width="80"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.microsoft.com"><img src="images/microsoft.png" height="80"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.disney.com"><img src="images/Companies/disney.png" height="70" width="110"></a>
      <span class="item1" style="background:#fff;"></span>
    </span>
    <span class="item-collection-2">
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.mckinsey.com"><img src="images/Companies/Mc.png" height="50" width="120"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.intel.com"><img src="images/Companies/intel.png" height="33" width="100"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.google.com"><img src="images/Companies/google1.png" height="30"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.walmart.com"><img src="images/Companies/walmart.png" height="120" width="140"></a>
      <span class="item1" style="background:#fff;"></span>
    </span>
    <span class="item-collection-1">
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.microsoft.com"><img src="images/microsoft.png" height="80"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.disney.com"><img src="images/Companies/disney.png" height="60" width="80"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.mckinsey.com"><img src="images/Companies/Mc.png" height="50" width="120"></a>
      <span class="item1" style="background:#fff;"></span>
      <a href="https://www.walmart.com"><img src="images/Companies/walmart.png" height="120" width="140"></a>
      <span class="item1" style="background:#fff;"></span>
    </span>
    <span class="item-collection-2">
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.intel.com"><img src="images/Companies/intel.png" height="33" width="100"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.google.com"><img src="images/Companies/google1.png" height="30"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.walmart.com"><img src="images/Companies/walmart.png" height="120" width="140"></a>
      <span class="item2" style="background:#fff;"></span>
      <a href="https://www.disney.com"><img src="images/Companies/disney.png" height="60" width="80"></a>
    </span>
  </div>
</div>

<!--
 <marquee width="100%" height="200px">
      <img src="images/apple.png">
      <img src="images/flipcart.jpg">
      <img src="images/netflix.png">
      <img src="images/samsung.png">
      <img src="images/goggle.png">
      <img src="images/microsoft.png">
      <img src="images/apple.png">
      <img src="images/flipcart.jpg">
      <img src="images/netflix.png">
      <img src="images/samsung.png">
      <img src="images/goggle.png">
      <img src="images/microsoft.png">
      <img src="images/apple.png">
      <img src="images/flipcart.jpg">
      <img src="images/netflix.png">
      <img src="images/samsung.png">
      <img src="images/goggle.png">
      <img src="images/microsoft.png">
      <img src="images/apple.png">
      <img src="images/flipcart.jpg">
      <img src="images/netflix.png">
      <img src="images/samsung.png">
      <img src="images/goggle.png">
      <img src="images/microsoft.png">
      <img src="images/apple.png">
      <img src="images/flipcart.jpg">
      <img src="images/netflix.png">
      <img src="images/samsung.png">
      <img src="images/goggle.png">
      <img src="images/microsoft.png">
</marquee>-->



<!-- Contact Us-->

<?php
include('./contact.php');
?>

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

</div>
</div> <!-- End Social Follow -->

<!-- Start About Section -->
<div class="container-fluid p-4" style="background-color: #E9ECEF">
  <div class="container" style="background-color: #E9ECEF">
    <div class="row text-center">

      <div class="col-sm" style="text-align: justify;">
        <h5 style="font-family: Playfair Display; font-size: 25px; font-weight: bold;">About Us</h5>
        <p style="font-size: 20px; font-family: nunito sans-serif;">StudyShine provides universal access to the world's best education, partnering with top universities and organizations to offer courses online.</p>
      </div>

      <div class="col-sm" style="text-align: center;">
        <h5 style="font-family: Playfair Display;font-size: 25px;font-weight: bold;">Category</h5>
        <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Development</a> <br />
        <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Design</a> <br />
        <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">IT and Software</a> <br />
        <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Business</a> <br />
        <a style="text-decoration:none;font-size: 20px;font-family: nunito sans-serif;" class="text-dark" href="#">Marketing</a> <br />
      </div>

      <div class="col-sm" style="text-align: justify;">
        <h5 style="font-family: Playfair Display;font-size: 25px;font-weight: bold;">Contact us</h5>
        <p style="font-size: 20px;font-family: nunito sans-serif;">StudyShine Pvt. Ltd. <br> Near Rupali Neher <br> Bhatar,
          Surat <br> Ph. 9835725173 </p>
      </div>

    </div>
  </div>
</div> <!-- End About Section -->

<!-- Chatbot button -->
<button id="toggleChatbot" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
  StudyShine Chatbot
  <t></t>
  <span class="lnr lnr-mustache" style="margin-left: 5px;"></span>
</button><!-- Add necessary designs -->
<style>
  /* Style the chatbot button */
  #toggleChatbot {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    background-color: #3B82F6;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  /* Chatbot container styles */
  #bot {
    display: none;
    position: fixed;
    bottom: 0;
    right: 0;
    z-index: 999;
    opacity: 0;
    background-color: white;
    width: 400px;
    max-height: 80vh;
    /* Set maximum height */
    overflow-y: auto;
    /* Enable vertical scroll */
    border-radius: 10px 10px 0 0;
    /* Rounded corners on top */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    /* Drop shadow */
    transition: opacity 0.3s ease;
    /* Fade-in/out transition */
  }

  /* Chatbot header styles */
  #header {
    background-color: #3B82F6;
    color: white;
    padding: 15px;
    border-radius: 10px 10px 0 0;
    /* Rounded corners on top */
  }

  /* Chatbot body styles */
  #body {
    padding: 15px;
  }

  /* User message styles */
  .user-message {
    background-color: #3B82F6;
    color: white;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
    max-width: 70%;
    /* Limit message width */
  }

  /* Bot reply styles */
  .bot-reply {
    background-color: #E5E7EB;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
    max-width: 70%;
    /* Limit message width */
  }

  /* Input area styles */
  #inputArea {
    display: flex;
    align-items: center;
    padding: 10px;
  }

  /* Text input styles */
  #userInput {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
  }

  /* Send button styles */
  #send {
    background-color: #3B82F6;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
  }
 
  /* Add fading effect for the chatbot container */
  #bot {
    /* Your existing styles */
    transition: opacity 0.5s ease-in-out;
  }

  #bot.fade-in {
    opacity: 1;
  }

  #bot.fade-out {
    opacity: 0;
  }

</style>

<!-- Chatbot container -->
<div id="bot" style="display: none; position: fixed; bottom: 70px; right: 0; z-index: 999; opacity: 0;">
  <div id="container"style="position: relative; height: 400px; overflow-y: auto;">
    <div id="header">
      StudyShine Bot
      <t></t>
  <span class="lnr lnr-mustache" style="margin-left: 5px;"></span>
    </div>

    <div id="body">
      <!-- This section will be dynamically inserted from JavaScript -->
      <div class="userSection">
        <div class="messages user-message"></div>
        <div class="seperator"></div>
      </div>
      <div class="botSection">
        <div class="messages bot-reply"></div>
      </div>
    </div>
  </div>
  <div id="inputArea" style="position: absolute; bottom: 0; left: 0; width: 100%;">
      <input type="text" name="messages" id="userInput" placeholder="Type your message" required style="width: calc(100% - 80px); padding: 10px;">
      <input type="submit" id="send" value="Send" style="width: 80px; padding: 10px;">
    </div>
</div>

<!-- JavaScript to toggle the chatbot container and clear old messages -->
<script>
// Function to toggle the chatbot container with fading effect
function toggleChatbot() {
  const chatbotContainer = document.getElementById('bot');
  chatbotContainer.style.display = (chatbotContainer.style.display === 'none') ? 'block' : 'none';
  chatbotContainer.style.opacity = (chatbotContainer.style.opacity === '0') ? '1' : '0';
  
  // Clear old messages when closing the chatbot
  if (chatbotContainer.style.display === 'none') {
    clearMessages();
  }
}

// Function to clear messages in the chatbot container
function clearMessages() {
  const userMessages = document.querySelectorAll('.user-message');
  const botReplies = document.querySelectorAll('.bot-reply');
  
  // Remove user messages
  userMessages.forEach(message => message.remove());
  
  // Remove bot replies
  botReplies.forEach(reply => reply.remove());
  
  // Remove last user-entered message if exists
  const userInput = document.getElementById('userInput');
  userInput.value = ''; // Clear input field
}

// Event listener for the toggle chatbot button
document.getElementById('toggleChatbot').addEventListener('click', toggleChatbot);
</script>

<script type="text/javascript">
document.querySelector("#send").addEventListener("click", async () => {
    let xhr = new XMLHttpRequest();
    var userMessage = document.querySelector("#userInput").value;

    // Debugging: Check if userMessage is captured correctly
    console.log("User Message:", userMessage);

    let userHtml = '<div class="userSection">' + '<div class="messages user-message">' + userMessage + '</div>' +
      '<div class="seperator"></div>' + '</div>';

    document.querySelector('#body').innerHTML += userHtml;

    xhr.open("POST", "query.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Send the data in the correct format
    xhr.send('messageValue=' + encodeURIComponent(userMessage));

    xhr.onload = function() {
      let botHtml = '<div class="botSection">' + '<div class="messages bot-reply">' + this.responseText + '</div>' +
        '<div class="seperator"></div>' + '</div>';

      document.querySelector('#body').innerHTML += botHtml;
    }

    // Clear the input field after sending the message
    document.querySelector("#userInput").value = '';
});
</script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>



<!-- Start Footer -->

<?php
include('./mainInclude/footer.php');
?>

<!--End of Footer-->