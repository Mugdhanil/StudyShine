<footer class="container-fluid bg-dark text-center p-2">
  <small class="text-white">Copyright &copy; 2024 || Designed By Komal & Mugdhanil ||
    <a href="#" data-bs-toggle="modal" data-bs-target="#AdminLoginModalCenter"> Admin Sign-in</a></small>
</footer>

<!-- HTML content with modal form -->
<div class="modal fade" id="stuRegModalCenter" tabindex="-1" aria-labelledby="stuRegModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="stuRegModalCenterLabel">Student Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Start include of Student Registration form -->
        <form id="stuRegForm" method="post">
          <div class="form-group">
            <i class="fas fa-user"></i> &nbsp;
            <label for="stuname" class="pl-2 font-weight-bold">Name</label>
            <small id="statusMsg1"></small>
            <input type="text" class="form-control" placeholder="Name" name="stuname" id="stuname" required>
          </div>
          <br>
          <div class="form-group">
            <i class="fas fa-envelope"></i> &nbsp;
            <label for="stuemail" class="pl-2 font-weight-bold">Email</label>
            <small id="statusMsg2"></small>
            <input type="email" class="form-control" placeholder="Email" name="stuemail" id="stuemail" required>
            <small class="form-text">We'll never share your email with anyone else.</small>
          </div>
          <br>
          <div class="form-group">
            <i class="fas fa-key"></i>
            <label for="stupass" class="pl-2 font-weight-bold">New Password</label>
            <small id="statusMsg3"></small>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" name="stupass" id="stupass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$!%*?&^])[A-Za-z\d@#$!%*?&^]{8,}" title="Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character." required>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
            <small class="form-text">Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character.</small>
          </div>
          <br>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btn_reg" id="signup">Send OTP</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearStuRegForm()">Cancel</button>
          </div>
        </form>

      </div>

      <div class="modal-footer">
        <!-- Sign In Button -->
        <p>Already Registered? </p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter" onclick="clearStuRegForm()">Sign In</button>
      </div>
    </div>
  </div>
</div>
<!--End include Student Registration form -->


<!-- JavaScript code -->

<script>
  document.getElementById('togglePassword1').addEventListener('click', function() {
    var passwordInput = document.getElementById('stupass');
    var icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });
  // Prevent default form submission behavior
  $('#stuRegForm').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Call the sendOTPAndVerify function
    //sendOTPAndVerify();
  });
  // Clear input fields in the Registration Modal
  function clearStuRegForm() {
    document.getElementById("stuRegForm").reset();
    document.getElementById("successMsg").innerHTML = "";
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}



if (isset($_POST['btn_reg'])) {
  $q = "select * from student where stu_email='$_POST[stuemail]'";
  $result = mysqli_query($conn, $q);
  if (mysqli_num_rows($result)) {
    $_SESSION['errmsg'] = "Email Address is already exists. Sign in instead.";
    echo "<script>$('##stuLoginModalCenter').modal('show');</script>";
  } else {
    if ($_POST['stuname'] != " " && $_POST['stuemail'] != " " && $_POST['stupass'] != " ") {
      $_SESSION['reg'] = 'True';
      // $_SESSION['rid'] = $_POST['R_id'];
      $_SESSION['stuname'] = $_POST['stuname'];
      $_SESSION['stuemail'] = $_POST['stuemail'];
      $_SESSION['stupass'] = $_POST['stupass'];
      // Generate OTP
      $otp = rand(100000, 999999);
      // Create a new PHPMailer instance
      $mail = new PHPMailer(true);

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'studyshine14@gmail.com';
        $mail->Password   = 'szgulcxkzqzcykbc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('studyshine14@gmail.com', 'StudyShine');
        $mail->addAddress($_SESSION['stuemail']);     // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'StudyShine - New Registration';
        $mail->Body    = "Hello $name,<br><br>Your One Time Password (OTP) for StudyShine Registration is: <strong>$otp</strong>.<br><br>Please use this OTP to complete your Registration.<br><br>Thank you.";

        if ($mail->send()) {
          $_SESSION['otp'] = $otp;
          $_SESSION['name'] = $_SESSION['stuname'];
          $_SESSION['email'] = $_SESSION['stuemail'];
          $_SESSION['password'] = $_SESSION['stupass'];
          $_SESSION['RegOTPChk'] = $otp;
          echo "<script>alert('OTP Sent to your Email. Kindly Check and Confirm.');</script>";
          echo "<script>location.href='OTP.php'</script>";
        } else {
          throw new Exception('Email sending failed: ' . $mail->ErrorInfo);
        }
      } catch (Exception $e) {
        echo "<script>alert('Failed to send OTP. Please try again. Error: " . $e->getMessage() . "');</script>";
      }
    }
  }
}
?>


<!-- Student Sign in Modal -->
<div class="modal fade" id="stuLoginModalCenter" tabindex="-1" aria-labelledby="stuLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="stuLoginModalCenterLabel">Student Sign In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="stuLoginForm"> <!-- Student Login form code-->
          <div class="form-group">
            <i class="fas fa-envelope"></i> &nbsp;
            <label for="stuLogemail" class="pl-2 font weight-bold">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="stuLogemail" id="stuLogemail">
          </div>
          <br>
          <div class="form-group">
            <i class="fas fa-key"></i>
            <label for="stuLogpass" class="pl-2 font-weight-bold">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" name="stuLogpass" id="stuLogpass">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
          </div>
          <br>
          <div class="form-group">
            <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Sign In</button>
            <button type="button" class="btn btn-secondary" onclick="clearStuLoginForm()" data-bs-dismiss="modal">Cancel</button>
            <!-- Forgot Password Button -->
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password</button>
          </div>

        </form>

      </div>

      <div class="modal-footer">
        <small id="statusLogMsg"></small>


        <!-- Sign Up Button -->
        <p> Don't have an Account?</p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#stuRegModalCenter" onclick="clearStuLoginForm()">Sign Up</button>

      </div>
    </div>
  </div>
</div>
<!--End of Student Login form Modal-->

<script>
  function checkStuLogin() {
    var stuLogEmail = $("#stuLogemail").val();
    var stuLogPass = $("#stuLogpass").val();

    $.ajax({
        url: "Student/addStudent.php",
        method: "POST",
        data: {
            checkLogemail: "checkLogemail",
            stuLogEmail: stuLogEmail,
            stuLogPass: stuLogPass
        },
        success: function(data) {
            if (data == 1) {
                // Redirect to the dashboard or desired page upon successful login
                $('#statusLogMsg').html('<small class="alert alert-success">Welcome.</small>');
                window.location.href = "index.php";
            } else {
                // Display error message if login fails
                $('#statusLogMsg').html('<small class="alert alert-danger">Invalid Email Id or Password</small>');
            }
        },
        error: function() {
            // Handle AJAX errors if any
            $('#statusLogMsg').html('<small class="alert alert-danger">Error occurred while processing your request</small>');
        }
    });
}

  document.getElementById('togglePassword2').addEventListener('click', function() {
    var passwordInput = document.getElementById('stuLogpass');
    var icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });

  function clearStuLoginForm() {
    // Clear input fields in the student login form
    document.getElementById("stuLoginForm").reset();
    document.getElementById("statusLogMsg").innerHTML = ""; // Clear any status message
  }
</script>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="forgotPasswordModalLabel">Forgot Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="forgotPasswordForm" method="post" action="OTP_reset.php"> <!-- Changed action to sendOTP.php -->
          <div class="form-group">
            <i class="fas fa-envelope"></i> &nbsp;
            <label for="forgotPasswordEmail" class="pl-2 font weight-bold">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="forgotPasswordEmail" id="forgotPasswordEmail">
          </div>
          <div class="modal-footer">
            <input type="submit" name="sendOTP1" id="sendOTP1" value="Send OTP" class="btn btn-primary">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearforgotPasswordForm()">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function clearforgotPasswordForm() {
    // Clear input fields in the student login form
    document.getElementById("forgotPasswordForm").reset();
    document.getElementById("forgotPasswordEmail").innerHTML = ""; // Clear any status message
  }
</script>




<!-- Admin Modal -->
<div class="modal fade" id="AdminLoginModalCenter" tabindex="-1" aria-labelledby="AdminLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="AdminLoginModalCenterLabel">Admin Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="AdminLoginForm"> <!-- Admin Login form code-->
          <div class="form-group">
            <i class="fas fa-envelope"></i> &nbsp;
            <label for="adminLogemail" class="pl-2 font weight-bold">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="adminLogemail" id="adminLogemail">
          </div>
          <br>
          <div class="form-group">
            <i class="fas fa-key"></i>
            <label for="adminLogpass" class="pl-2 font-weight-bold">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" name="adminLogpass" id="adminLogpass">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="toggleAdminPassword">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <small id="statusAdminLogMsg"></small>
        <button type="button" class="btn btn-primary" id="AdminLoginBtn" onclick="checkAdminLogin()">Sign In</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearForm()">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- End of admin Login-->

<script>
  document.getElementById('toggleAdminPassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('adminLogpass');
    var icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });

  function clearForm() {
    document.getElementById("AdminLoginForm").reset();
    document.getElementById("statusAdminLogMsg").innerHTML = ""; // Clear any status message
  }
</script>

<!-- Bootstrap and Jquery JS-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- font awesome JS-->
<script src="js/all.min.js"></script>





<!-- Student AJax Call JS-->
<script type="text/javascript" src="js/ajaxrequest.js"></script>

<!-- Admin AJax Call JS-->
<script type="text/javascript" src="js/adminajaxrequest.js"></script>

</body>

</html>