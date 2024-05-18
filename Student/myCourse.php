<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
    $sql_student_id = "SELECT stu_id FROM student WHERE stu_email = '$stuEmail'";
    $result_student_id = $conn->query($sql_student_id);
    if ($result_student_id->num_rows > 0) {
        $row_student_id = $result_student_id->fetch_assoc();
        $stu_id = $row_student_id['stu_id'];
    } else {
        echo "<p class='text-danger'><strong>Error:</strong> Fetching Course Completion Data. Please try again later!</p>";
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
}
$coursePending = false;
$courseCertificate = false;
?>

<body>
    <div class="container col-sm-6 mt-3 ml-3" style="margin-left:60px;">
        <div class="row">
            <div class="jumbotron">
                <h4 class="text-center" style="font-family: Playfair Display; font-size: 45px; font-weight: 700;">All Courses</h4>
                <br>
                <hr>

                <?php
                if (isset($stuEmail)) {
                    $sql = "SELECT * FROM payment AS p JOIN course AS c ON c.course_id = p.course_id WHERE p.stu_email = '" . $stuEmail . "'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Check if the course has begun
                            $sql_check_progress = "SELECT * FROM progress WHERE stu_id = '$stu_id' AND course_id = '" . $row['course_id'] . "'";
                            $result_check_progress = $conn->query($sql_check_progress);
                            $anyCourseStarted = ($result_check_progress->num_rows > 0);

                            // Fetch lesson_id associated with the course from the lesson table
                            $sql_fetch_lesson_id = "SELECT lesson_id FROM lesson WHERE course_id = '" . $row['course_id'] . "'";
                            $result_fetch_lesson_id = $conn->query($sql_fetch_lesson_id);
                            $row_fetch_lesson_id = $result_fetch_lesson_id->fetch_assoc();
                            $lesson_id = $row_fetch_lesson_id['lesson_id']; // Lesson ID associated with the current course

                            // Check if the course has been completed
                            $courseId = $row['course_id'];

                            $sql_check_completion = "SELECT * FROM certificates WHERE course_id = '$courseId' AND stu_id = '$stu_id'";
                            $result_check_completion = $conn->query($sql_check_completion);
                            $courseCompleted = ($result_check_completion->num_rows > 0);

                            // Grey Box Message for Course Not Begun
                            if (!$anyCourseStarted) {
                                echo '<p class="alert alert-secondary" style="margin-top: 20px; style="font-family: Nunito sans-serif; border-radius: 50px; font-size: 17px;"><strong>Pending:</strong> Course has not begun. Start learning now.</p>';
                            }
                            // Check if the course is pending to complete
                            $coursePending = false; // Initialize $coursePending outside the loop
                            if (!$courseCompleted && $anyCourseStarted) {
                                $sql_check_progress = "SELECT * FROM progress WHERE course_id = '$courseId' AND stu_id = '$stu_id'";
                                $result_check_progress = $conn->query($sql_check_progress);
                                if ($result_check_progress->num_rows > 0) {
                                    // Initialize $allLessonsWatched as true
                                    $allLessonsWatched = true;

                                    // Check if all lessons are watched
                                    while ($progressRow = $result_check_progress->fetch_assoc()) {
                                        // Check if 'watched' key exists and is not equal to 1
                                        if (!isset($progressRow['watched']) || $progressRow['watched'] != 1) {
                                            $allLessonsWatched = false;
                                            break;
                                        }
                                    }
                                    // If any lesson is not watched, set $coursePending to true
                                    if (!$allLessonsWatched) {
                                        $coursePending = true;
                                    } else {
                                        if ($courseCompleted && !$courseCertificate) {
                                            $courseCertificate = true;
                                        }
                                    }
                                } else {
                                    // Yellow Box Message for Completed Course but No Certificate Downloaded Yet
                                    if ($courseCompleted && !$courseCertificate) {
                                        $courseCertificate = true;
                                    }
                                }
                            } // If no progress is found, Grey box comes to true
                            else {
                                //echo '<p class="alert alert-secondary" style="margin-top: 20px; style="font-family: Nunito sans-serif; border-radius: 50px; font-size: 17px;"><strong>Pending:</strong> Course has not begun. Start learning now.</p>';
                            }



                ?>
                            <div class="bg-light mb-3" style="padding-top: 20px;">
                                <h5 class="card-header" style="margin-top:10px;"><?php echo $row['course_name']; ?></h5>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?php echo $row['course_img']; ?>" style="height:180px; width:180px;" class="card-img-top mt-4" alt="pic">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <br>
                                        <div class="card-body">
                                            <p class="card-title"><?php echo $row['course_desc']; ?></p>
                                            <small class="card-text"> <strong>Duration: </strong><?php echo $row['course_duration']; ?> Hours</small><br />
                                            <small class="card-text"><strong>Instructor: </strong><?php echo $row['course_author']; ?></small><br />
                                            <?php
                                            // Check if the course is completed
                                            if ($courseCompleted) {
                                                echo '<p class="alert alert-success"><strong>Success:</strong> Course Completed. Certificate downloaded.</p>';
                                                // Modify the link to include both course_id and lesson_id
                                                echo '<a href="watchcourse.php?course_id=' . $row['course_id'] . '&lesson_id=' . $lesson_id . '&course_name=' . urlencode($row['course_name']) . '" class="btn btn-primary mt-5 float-right" style="font-family: Nunito sans-serif; border-radius: 50px; background: #fd917e; border-color: #fd917e; font-size: 17px; display: inline; margin-left: 160px;">View Course Again</a>';
                                            } else {
                                                // Modify the link to include both course_id and lesson_id
                                                echo '<a href="watchcourse.php?course_id=' . $row['course_id'] . '&lesson_id=' . $lesson_id . '&course_name=' . urlencode($row['course_name']) . '" class="btn btn-primary mt-5 float-right" style="font-family: Nunito sans-serif; border-radius: 50px; background: #fd917e; border-color: #fd917e; font-size: 17px; display: inline; margin-left: 160px;">View Course</a>';
                                            }
                                            if ($courseCertificate) {
                                                echo '<p class="alert alert-warning" style="margin-top: 20px;"><strong>Attention:</strong> You have completed the course, but haven\'t downloaded the certificate yet.</p>';
                                            }
                                            // Red Box Message for Pending Course Completion
                                            if ($coursePending) {
                                                echo '<p class="alert alert-danger" style="margin-top: 20px;"><strong>Pending:</strong> Course is pending to complete. Finish your learning & Avail your Certificate.</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                <?php
                        }
                    } else {
                        // If no courses found, display message and enroll button
                        echo '<div style="text-align: center;">';
                        echo ' <p class="text-danger" style="text-align: center;"><strong>You have not purchased any Courses.</strong></p>';
                        echo '<a href="../courses.php" class="btn btn-danger mt-3" style="font-family: \'Nunito\', sans-serif; border-radius: 50px; font-size: 17px;">Enroll Now</a></div>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
    </div>
</body>
<?php
include('./stuInclude/footer.php');
?>