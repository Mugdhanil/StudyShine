<?php

include('./dbConnection.php');
include('./mainInclude/header.php');


?>
<?php

if (!isset($_SESSION['stuLogEmail'])) {
   //echo "<script> location.href = 'loginorsignup.php'  </script>";
   echo "<script>alert('Kindly Sign in first to Buy the Course. Thanks.');</script>";
   echo "<script>location.href='index.php'</script>";
   //exit(); // Stop further execution
} else {

?>
  <?php

  if (isset($_GET['course_id'])) {

    $course_id = $_GET['course_id'];
    $_SESSION['course_id'] = $course_id;
    $sql = "SELECT *FROM course WHERE course_id = '$course_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }

  ?>



  <!--Start of course banner----
<div class = "container-fluid bg-dark">
    <div class = "row">
        <img src = "./images/coursebanner.jpg" alt = "courses"
        style = "height:470px; width:100%; object-fit:cover; box-shadow:10px;"/> 
    </div>      
</div>
End of course banner---->

  <!--Start-->
  <html>

  <head>
    <link rel="stylesheet" href="css/paymentstyle.css">
    <script>
  function validateForm() {
    console.log("Validating form...");
    var expMonth = document.getElementById("expmonth").value;
    var expYear = document.getElementById("expyear").value;

    // Convert month to number
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var currentMonthIndex = new Date().getMonth();
    var selectedMonthIndex = months.indexOf(expMonth);

    // Convert year to number
    var currentYear = new Date().getFullYear();
  
    // Validate expiry month
  if (selectedMonthIndex === -1) {
        alert("Please enter a valid month name (e.g., January, February, etc.).");
        return false;
      }
      // Validate expiry month and year
      if (expYear < currentYear || (expYear == currentYear && selectedMonthIndex < currentMonthIndex)) {
        alert("Please enter a valid expiry date (from the current month onwards).");
        return false;
      }

      var maxExpiryYear = currentYear + 6;
      if (expYear > maxExpiryYear) {
        alert("Card expiry year should not be greater than 6 years from the current year.");
        return false;
      }
    return true;
  }
</script>
  </head>

  <body>

    <div class="row">
      <div class="col-75" style="background:#B9D9EB;">
        <div class="container" style="margin-top:85px;width:70%;margin-bottom: 45px;">
          <form action="./paymentstatus.php?course_id=<?php echo $course_id; ?>" method="POST" onsubmit="return validateForm()">

            <div class="row">
              <div class="col-50">
                <h3>Student Details</h3>

                <?php
                // Fetch student name from database based on email
                $stuLogEmail = $_SESSION['stuLogEmail'];
                $sql = "SELECT stu_name FROM student WHERE stu_email = '$stuLogEmail'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $stuName = $row['stu_name'];
                  }
                } else {
                  $stuName = ''; // Set default value if no data found
                }
                ?>

                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" value="<?php echo $stuName; ?>" readonly>

                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" value="<?php echo $stuLogEmail; ?>" readonly>

                <label for="adr"><i class="fa-solid fa-location-dot"></i>Address</label>
                <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="New York" required>
                <label for="date">Date</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date" name="date" readonly>

                <div class="row">
                  <div class="col-50">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder="NY" required>
                  </div>
                  <div class="col-50">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="10001" required>
                  </div>
                </div>
              </div>

              <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                  <i class="fa-brands fa-cc-visa"></i>
                  <i class="fa-brands fa-cc-amex"></i>
                  <i class="fa-brands fa-cc-mastercard"></i>
                  <i class="fa-brands fa-cc-discover"></i>
                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required pattern="\d{4}-\d{4}-\d{4}-\d{4}">
                <label for="expmonth">Exp Month</label>
                <input type="text" id="expmonth" name="expmonth" placeholder="September" required>

                <div class="row">
                  <div class="col-50">
                    <label for="expyear">Exp Year</label>
                    <input type="text" id="expyear" name="expyear" placeholder="2018" required>
                  </div>
                  <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="password" id="cvv" name="cvv" placeholder="352" required pattern="\d{3}" style= "width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px">
                  </div>
                </div>
              </div>

            </div>
            <div class="text-center m-2">

            </div>
            <div class="text-center m-2">
              <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" style="background: #fd917e; width: 20%; border-radius: 50px; border-color: #fd917e; font-size: 20px; font-family: Nunito sans-serif;">Continue</button>
            </div>

          </form>
          <small id="paystatusMsg"></small>
        </div>
      </div>



 
<!-- Modal dialog for payment status -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Payment successful or failed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="successBtn">Success</button>
                    <button type="button" class="btn btn-danger" id="failureBtn">Failure</button>
                </div>
            </div>
        </div>
    </div>
    </body>

</html>
    <script>
        $(document).ready(function() {
            $('#paymentModal').modal('show'); // Show the modal dialog when the page loads

            $('#successBtn').click(function() {
                // Redirect to responsee.php if success button is clicked
                window.location.href = "paymentstatus.php?course_id=<?php echo $course_id; ?>";
            });

            $('#failureBtn').click(function() {
                // Redirect to course.php if failure button is clicked
                window.location.href = "courses.php";
            });
        });
    </script>


<?php
}
include('./mainInclude/footer.php');
?>