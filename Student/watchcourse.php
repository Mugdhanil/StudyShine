<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
    $sql_student_id = "SELECT stu_id FROM student WHERE stu_email = '$stuEmail'";
    $result_student_id = $conn->query($sql_student_id);
    if ($result_student_id->num_rows > 0) {
        $row_student_id = $result_student_id->fetch_assoc();
        $stu_id = $row_student_id['stu_id'];
    } else {
        echo "Error";
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Check if the required parameters are received via GET request
if (isset($_GET['course_id']) && isset($_GET['lesson_id'])) {
    $courseId = $_GET['course_id'];
    $lessonId = $_GET['lesson_id'];

    // Get the current date and time for the 'completed_at' field
    $completedAt = date('Y-m-d H:i:s');

    // Insert a new record into the 'progress' table
    $sql = "INSERT INTO progress (lesson_id, course_id, stu_id, completed_at) VALUES ('$lessonId', '$courseId', '$stu_id', '$completedAt')";

    if ($conn->query($sql) === TRUE) {
        // If the insertion is successful, send a success response
        echo "<script> alert(Progress updated successfully)</script>";
    } else {
        // If there's an error with the SQL query, send an error response
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If either course_id or lesson_id parameter is missing, send an error response
    echo "Error: Required parameters (course_id or lesson_id) are missing";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Watch Course</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/stustyle.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <style>
        .completed-lesson {
            color: green;
        }

        /* Updated CSS for lessons container */
        .lessons-container {
            overflow-y: auto;
            max-height: 500px;
            /* Adjust as needed */
        }

        /* Style for lesson items */
        .lesson {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .lesson:last-child {
            border-bottom: none;
        }

        /* Style for active lesson */
        .lesson.active {
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        /* Adjusted video container style */
        .video-container {
            margin-top: 30px;
            margin-left: auto;
            margin-right: 30px;
            /* Adjust the right margin as needed */
            width: 60%;
            /* Adjust the width as needed */
            max-height: 500px;
            /* Limit the maximum height to prevent excessive scaling */
            overflow: hidden;
            /* Hide overflow content */
            border-radius: 10px;
            /* Add a border radius for a more modern look */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow for depth */
        }

      
    </style>

</head>

<body>
    <?php
    // Retrieve the course name from the URL parameter
    if (isset($_GET['course_name'])) {
        $courseName = $_GET['course_name'];
    } else {
        $courseName = "Unknown Course";
    }
    ?>

    <div class="container-fluid bg-success" style="display:flex;padding:10px;background-color:#cca384">
        <h3 style="font-size: 30px; font-family: playfair display; font-weight: bold; ">StudyShine|Course</h3>
        <h4 style="font-size: 20px; font-family: playfair display; font-weight: bold; margin-top: 10px;margin-left: auto;">Course Name: <?php echo $courseName; ?></h4>
        <button id="downloadCertificateBtn" class="btn btn-primary btn-lg" onclick="downloadCertificate()" style="margin-left: auto; font-family: Nunito sans-serif; border-radius: 50px; background-color: #0066cc; border-color: #0066cc; font-size: 20px; transition: transform 0.2s;">Download Certificate</button>
        <a class="btn btn-danger btn-lg" href="./myCourse.php" style="margin-left:auto; font-family: Nunito sans-serif; border-radius: 50px; 
        background-color: #FF0000; border-color: #FF0000; font-size: 20px; transition: transform 0.2s;">Back to My Courses</a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 border-right">
                <h4 class="text-center" style="margin-right: auto; margin-top: 20px; font-size: 30px; font-family: playfair display; font-weight: bold;">Course Lessons</h4>
                <div class="lessons-container">
                    <div class="lessons-wrapper">
                        <ul id="playlist" class="lessons-list">
                            <ul id="playlist" class="nav flex-column" style="margin-right: 200px; margin-top: 20px; font-size: 20px; font-family: nunito sans; width: 100%;"> <!-- Adjusted width -->
                                <?php
                                // Initialize a variable to track if the certificate is downloaded
                                $certificateDownloaded = false;

                                // Check if the certificate is downloaded for the current student and course
                                $sql_check_certificate = "SELECT * FROM certificates WHERE stu_id = '$stu_id' AND course_id = '$courseId'";
                                $result_check_certificate = $conn->query($sql_check_certificate);
                                if ($result_check_certificate->num_rows > 0) {
                                    $certificateDownloaded = true;
                                }

                                // Initialize an array to store completed lesson IDs
                                $completedLessonIds = array();

                                // Fetch completed lesson IDs for the current student and course
                                $sql_completed_lessons = "SELECT lesson_id FROM progress WHERE stu_id = '$stu_id' AND course_id = '$courseId'";
                                $result_completed_lessons = $conn->query($sql_completed_lessons);
                                if ($result_completed_lessons->num_rows > 0) {
                                    while ($row_completed_lesson = $result_completed_lessons->fetch_assoc()) {
                                        $completedLessonIds[] = $row_completed_lesson['lesson_id'];
                                    }
                                }

                                if (isset($_GET['course_id'])) {
                                    $courseId = $_GET['course_id'];
                                    $sql = "SELECT * FROM lesson WHERE course_id =' $courseId'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $counter = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $lesson_id = $row['lesson_id'];
                                            $sql_check_progress = "SELECT * FROM progress WHERE lesson_id = '$lesson_id' AND stu_id = '$stu_id'";
                                            $result_progress = $conn->query($sql_check_progress);
                                            
                                    //With Database Fetching but shows 1st Lesson name Green.
                                           $watched_class = (in_array($lesson_id, $completedLessonIds)) ? "completed-lesson" : "";
                                            
                                           //Without Database Fetching but does not show any Green success over lesson name 
                                          // $watched_class = (in_array($lesson_id, $completedLessonIds) && $counter != 1) ? "completed-lesson" : "";

                                            // Change the class based on certificate download status
                                            if ($certificateDownloaded) {
                                                // If certificate is downloaded, set class to yellow
                                                $watched_class = "certificate-downloaded";
                                            }

                                            // Add data-lesson-id attribute to store lesson ID
                                            echo '<li class="nav-item lesson border-bottom py-2 ' . $watched_class . '" data-lesson-id="' . $lesson_id . '" onclick="playVideo(event, \'' . $row['lesson_link'] . '\')" style="cursor: pointer; white-space: nowrap;"><span class="lnr lnr-arrow-right-circle"></span> ' . $counter . '. ' . $row['lesson_name'] . '</li>';
                                            $counter++;
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="video-container">
                <video id="videoarea" style="width: 100%; height: auto;" controls></video>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap and Jquery JS-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>



    <!-- Custom javascript -->

    <script>
        // Function to handle video end event
        function handleVideoEnd() {
            var lessonItem = document.querySelector('.lesson.active');
            if (lessonItem && !lessonItem.classList.contains('completed-lesson')) {
                lessonItem.classList.add('completed-lesson');
                var lessonId = lessonItem.dataset.lessonId;
                var courseId = <?php echo $courseId; ?>;
                var stuEmail = "<?php echo $stuEmail; ?>";
                var stuId = <?php echo $stu_id; ?>;
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "watchCourse.php?lesson_id=" + lessonId + "&course_id=" + courseId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log("Progress updated successfully");
                            alert("Lesson Complete. Progress Saved.");
                            checkAllLessonsCompleted();
                        } else {
                            console.error("Error in updating progress");
                            alert("Error in updating progress");
                        }
                    }
                };
                xhr.send();
            }
        }

        // Function to check if all lessons are completed
        function checkAllLessonsCompleted() {
            var lessonItems = document.querySelectorAll('.lesson');
            var allCompleted = true;
            lessonItems.forEach(function(item) {
                if (!item.classList.contains('completed-lesson')) {
                    allCompleted = false;
                }
            });
            var downloadBtn = document.getElementById('downloadCertificateBtn');
            if (allCompleted) {
                downloadBtn.removeAttribute('disabled');
            } else {
                downloadBtn.setAttribute('disabled', 'disabled');
            }
        }

        // Function to play video
        function playVideo(event, videoURL) {
            var videoArea = document.getElementById("videoarea");
            videoArea.removeAttribute('autoplay');
            videoArea.src = videoURL;
            videoArea.play();
            videoArea.addEventListener('ended', handleVideoEnd);
            var lessonItems = document.querySelectorAll('.lesson');
            lessonItems.forEach(function(item) {
                item.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Function to handle certificate download
        // Function to handle certificate download
        function downloadCertificate() {
            var downloadBtn = document.getElementById('downloadCertificateBtn');

            // Check if all lessons are completed
            var completedLessonItems = document.querySelectorAll('.lesson');
            var allLessonsCompleted = true;
            completedLessonItems.forEach(function(item) {
                if (!item.classList.contains('completed-lesson')) {
                    allLessonsCompleted = false;
                }
            });

            // If all lessons are completed, allow download
            if (allLessonsCompleted) {
                alert('Note: Kindly store all Course Certificates in the "elearning/certificates" folder for later access.');
                // Construct the URL for generating the certificate
                var certificateURL = 'generate_certificate.php?course_id=<?php echo $courseId; ?>&stu_email=<?php echo $stuEmail; ?>';

                // Request the certificate generation
                var xhr = new XMLHttpRequest();
                xhr.open("GET", certificateURL, true);
                xhr.responseType = "blob";
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Create a blob from the response
                        var blob = new Blob([xhr.response], {
                            type: "application/pdf"
                        });

                        // Create a link element to trigger the download
                        var link = document.createElement("a");
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "<?php echo 'StudyShine_Course_Certificate_' . date('dmYhi') . '.pdf'; ?>";

                        // Append the link to the document body and trigger the click event
                        document.body.appendChild(link);
                        link.click();

                        // Cleanup: remove the link and revoke the object URL
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(link.href);
                    }
                };
                xhr.send();
            } else {
                // Show alert message if all lessons are not completed
                alert("Kindly finish all the Lessons to Download the 'StudyShine Course Completion Certificate'.");
            }
        }

        // Initially check if all lessons are completed
        checkAllLessonsCompleted();
    </script>



</body>

</html><?php
include('./stuInclude/footer.php');
?>