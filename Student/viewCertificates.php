<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];

    // Fetch student ID
    $sql_student_id = "SELECT stu_id FROM student WHERE stu_email = '$stuEmail'";
    $result_student_id = $conn->query($sql_student_id);

    if ($result_student_id->num_rows > 0) {
        $row_student_id = $result_student_id->fetch_assoc();
        $stu_id = $row_student_id['stu_id'];
?>
        <div class="col-sm-6 mt-5" style="background: #f3f7f9; margin-left: 200px;">
            <div class="row">
                <h4 class="text-center" style="font-family: Playfair Display; font-size: 45px; font-weight: 700;">View Certificates</h4>
                <hr>
                <?php
                // Query to fetch certificates related to courses bought by the student
                $sql = "SELECT c.course_name, ce.* FROM certificates ce JOIN course c ON ce.course_id = c.course_id WHERE ce.stu_id = '$stu_id'";
                $result = $conn->query($sql);

                // Check if there are any certificates
                if ($result->num_rows > 0) {
                    // Output data of each row
                ?>

                    <div class="row justify-content-center">
                        <div class="card-body">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-file-pdf"></i> Course Name: <?php echo $row["course_name"]; ?></h5>
                                        <div class="btn-group mt-3">
                                            <a href="../certificates/<?php echo $row["certificate_link"]; ?>" download class="btn btn-primary" style="border-radius: 25px;">Download Certificate</a></div>
                                            <div class="btn-group mt-3">  <button class="btn btn-danger" style="border-radius: 25px;" onclick="deleteCertificate(<?php echo $row["id"]; ?>)">Remove Certificate</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
            </div>
        </div>
        <script>
            function deleteCertificate(id) {
                if (confirm("Are you sure you want to remove this certificate?")) {
                    // Send AJAX request to delete certificate
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Reload the page after successful deletion
                                window.location.reload();
                            } else {
                                // Handle error
                                alert('Error deleting certificate');
                            }
                        }
                    };
                    xhr.open("GET", "delete_certificate.php?id=" + id, true);
                    xhr.send();
                }
            }
        </script>
<?php
                } else {
                    // If no certificates found for the student
                    echo "<div class='col-sm-6 mt-5' style='background: #f3f7f9; margin-left: 200px;'><div class='jumbotron'><p class='text-center'>No completed certificates found.</p></div></div>";
                }
            } else {
                // If student ID not found
                echo "<div class='col-sm-6 mt-5' style='background: #f3f7f9; margin-left: 200px;'><div class='jumbotron'><p class='text-center'>Error fetching student data.</p></div></div>";
            }
        } else {
            // If user is not logged in
            echo "<script> location.href='../index.php'; </script>";
        }

        $conn->close(); // Close the database connection
        include('./stuInclude/footer.php');
?>