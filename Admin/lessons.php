<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href= '../index.php'; </script>";
}
?>
<div class="col-sm-9 mt-5 mx-3" style="width:75%">
    <form action="" class="mt-3 form-inline d-print-none">
        <div class="form-group mr-3" style="font-size: 20px; font-family: nunito ui-sans-serif; font-weight: bold;">
            <label for="checkid"> Select Course ID: </label>
            <select class="form-control ml-3" id="checkid" name="checkid">
                <option value="" disabled selected>Select Course ID</option>
                <?php
                $sql = "SELECT course_id FROM course";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['course_id'] . '">' . $row['course_id'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" style="width: 10%; border-radius: 40px; margin-top: 10px;" class="btn btn-danger">Search</button>
    </form>
    <?php
if (isset($_REQUEST['checkid'])) {
    $selected_course_id = $_REQUEST['checkid'];

    // Validate if the selected course ID exists in the database
    $sql = "SELECT * FROM course WHERE course_id = '$selected_course_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['course_id'] = $row['course_id'];
        $_SESSION['course_name'] = $row['course_name'];

        // Fetch lessons for the selected course ID
        $sql_lessons = "SELECT * FROM lesson WHERE course_id = '$selected_course_id'";
        $result_lessons = $conn->query($sql_lessons);

        if ($result_lessons->num_rows > 0) {
             // Add Lessons inside of Courses
            if (isset($_SESSION['course_id'])) {
                echo '<div>
                        <a class="btn btn-danger box" href="addLesson.php">
                            <i class="fas fa-plus fa-2x"></i>
                        </a>
                    </div>';
            }
            // Display lessons in a table
            echo '<h3 class="mt-5 bg-dark text-white p-2">Course ID: ' . $_SESSION['course_id'] . ' Course Name: ' . $_SESSION['course_name'] . '</h3>';
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Lesson ID</th>
                            <th scope="col">Lesson Name</th>
                            <th scope="col">Lesson Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row_lessons = $result_lessons->fetch_assoc()) {
                echo '<tr>
                        <th scope="row">' . $row_lessons['lesson_id'] . '</th>
                        <td>' . $row_lessons['lesson_name'] . '</td>
                        <td>' . $row_lessons['lesson_link'] . '</td>
                        <td>
                            <form action="editlesson.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="' . $row_lessons["lesson_id"] . '">
                                <button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button>
                            </form>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="' . $row_lessons["lesson_id"] . '">
                                <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-dark mt-4" role="alert">No lessons found for the selected course.</div>';
            if (isset($_SESSION['course_id'])) {
                echo '<div>
                        <a class="btn btn-danger box" href="addLesson.php">
                            <i class="fas fa-plus fa-2x"></i>
                        </a>
                    </div>';
            }
        }
    } else {
        echo '<div class="alert alert-dark mt-4" role="alert">Course Not Found</div>';
    }
}

// Handle lesson deletion
if (isset($_POST['delete'])) {
    $lesson_id = $_POST['id'];
    
    // Delete lesson from the database
    $sql_delete_lesson = "DELETE FROM lesson WHERE lesson_id = '$lesson_id'";
    if ($conn->query($sql_delete_lesson) === TRUE) {
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Error deleting lesson: ' . $conn->error . '</div>';
    }
}
?>
</div>

<?php
include('./adminInclude/footer.php');
?>