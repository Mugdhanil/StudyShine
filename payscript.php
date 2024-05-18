<?php
if (!isset($_SESSION)) {
    session_start();
}

$apiKey = "rzp_test_4fdfSU1OCN3pbQ";
include('./dbConnection.php');


if (!isset($_SESSION['stuLogEmail'])) {
    //echo "<script> location.href = 'loginorsignup.php'  </script>";
    echo "<script>alert('Kindly Sign in first to Buy the Course. Thanks.');</script>";
    echo "<script>location.href='index.php'</script>";
    //exit(); // Stop further execution
}

// Check if the course_id is set in the URL parameters
if (!isset($_GET['course_id'])) {
    echo "Course ID not provided.";
    exit(); // Stop further execution
} else {
    // Check if the course_id is set in the URL parameters
    if (isset($_GET['course_id'])) {
        // Retrieve the course_id from the URL parameter
        $course_id = $_GET['course_id'];

        // Fetch course details from the database
        $sql_course = "SELECT * FROM course WHERE course_id = '$course_id'";
        $result_course = $conn->query($sql_course);

        if ($result_course->num_rows > 0) {
            $row_course = $result_course->fetch_assoc();

            // Fetch payment details from the session
            if (isset($_SESSION['stuLogEmail'])) {
                $stuLogEmail = $_SESSION['stuLogEmail'];

                // Fetch student details from the database
                $sql_student = "SELECT * FROM student WHERE stu_email = '$stuLogEmail'";
                $result_student = $conn->query($sql_student);

                if ($result_student->num_rows > 0) {
                    $row_student = $result_student->fetch_assoc();

                    // Insert payment details along with course details into the payment table
                    $p_date = date("Y-m-d H:i:s"); // Get current date and time
                    $stu_name = $row_student['stu_name'];
                    $stu_email = $row_student['stu_email'];
                    $course_price = $row_course['course_price'];

                    //$sql_insert_payment = "INSERT INTO payment (p_date, stu_name, stu_email, course_id, course_price) VALUES ('$p_date', '$stu_name', '$stu_email', '$course_id', '$course_price')";


?>

<?php

                } else {
                    echo "No student details found.";
                }
            } else {
                echo "No student email found in session.";
            }
        } else {
            echo "No course found with the provided course ID.";
        }
    } else {
        echo "Course ID not provided.";
    }
}
?>

<body>
    <style>
        body {
            background-color: #f7f7f7;
            /* Set background color */
            font-family: Arial, sans-serif;
            background-color: #B9D9EB;
            /* Set font */
        }

        .container {
            /* max-width: 600px; */
            margin: 100px auto 20px;
            padding: 20px;
            text-align: center;
            /* Center align all text content */
        }

        /* Add custom styles to the payment info */
        .payment-info {
            background-color: #fff;
            /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
            margin-bottom: 20px;
            /* Add margin to create space between payment info and button */
            text-align: left;
            /* Left align the text */
            width: fit-content;
            margin-left: 400px;
        }

        .payment-info h2 {
            color: #333;
            /* Dark text color */
            font-size: 24px;
            margin-bottom: 10px;
        }

        .payment-info p {
            color: #666;
            /* Light text color */
            font-size: 16px;
            list-style-type: square;
            /* Use square bullets */
            margin-left: 20px;
            /* Add indentation for the bullets */
        }

        /* Add custom styles to the button */
        .razorpay-payment-button {
            background: #fd917e;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        /* Change button color on hover */
        .razorpay-payment-button:hover {
            background-color: #E35438;
        }

        .payment-info ul {
            list-style-type: square;
            /* Remove default list style */
            padding-left: 1;
            /* Remove default left padding */
        }

        .payment-info li:before {
            content: "\2022";
            /* Unicode character for square bullet */
            color: #666;
            /* Bullet color */
            display: inline-block;
            width: 2rem;
            margin-left: -1em;
        }

        .navbar-brand {
            font-family: 'Titillium Web';
            font-size: 2em;
            font-weight: bold;
            color: #fff;
            margin-top: 100px;

        }

        .fixed-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            width: 100%;
            height: 70px;
        }
        
    </style>

    </div>

    <div class="center-container">
        <div class="container">

            <!-- Back button -->

            <!-- Relevant payment information -->
            <div style="text-align: center;">
                <h1>Complete Your Purchase</h1>
            </div>
            <div class="payment-info">
                <h2>Pay for <strong><?php echo $row_course['course_name']; ?> </strong></h2> <br>
                <ul>
                    <li>This is a one-time payment for the course .</li> <br>
                    <li>Once you make the payment, you'll get access to all the course materials and resources.</li> <br>
                    <li>If you have any questions or concerns, feel free to <a href="contactus.php">contact us</a>.</li> <br>
                </ul>
            </div>
            <!-- Razorpay button -->


            <div class="razorpay-payment-button-wrapper">
                <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
                <form action="/elearning/payscript_insert.php" method="POST"> <!-- Change the action attribute to point to the PHP script -->
                    <!-- Add input fields for course_id, stu_name, and stu_email -->
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <input type="hidden" name="course_price" value="<?php echo $course_price; ?>">
                    <input type="hidden" name="stu_name" value="<?php echo $stu_name; ?>">
                    <input type="hidden" name="stu_email" value="<?php echo $stu_email; ?>">

                    <!-- Include Razorpay checkout script -->
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $apiKey; ?>" data-amount="<?php echo $course_price * 100; ?>" data-currency="INR" data-id="<?php echo 'O_ID' . rand(10, 100) . 'END'; ?>" data-buttontext="Click here to Pay" data-name="StudyShine" data-description="Lifetime Knowledge" data-image="" data-prefill.name="<?php echo $stu_name; ?>" data-prefill.email="<?php echo $stu_email; ?>" data-theme.color="#F37254">
                    </script>

                    <!-- Hidden element for additional data if needed -->
                    <input type="hidden" custom="Hidden Element" name="hidden">
                </form>
            </div>
            <button onclick="window.location.href = 'courses.php'" style="background-color: red; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;">Back</button>
            <!-- Add jQuery if needed -->
            <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</body>
