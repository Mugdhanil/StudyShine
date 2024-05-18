<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../dbConnection.php');

//Email already exists code
if(isset($_POST['checkemail']) && isset($_POST['stuemail'])) {
    $stuemail = $_POST['stuemail'];
   
    $sql = "SELECT stu_email FROM student WHERE stu_email = '".$stuemail."'";
    $result = $conn -> query($sql);
    $row = $result -> num_rows;
    echo json_encode($row);
}


//Insert student
if(isset ($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass']))
{
    $stuname =  $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stupass = $_POST['stupass'];
    $hashed_password = password_hash($stupass, PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO student (stu_name , stu_email, stu_pass) VALUES ('$stuname', '$stuemail', '$hashed_password')";

    if($conn->query($sql) == TRUE) {
        echo json_encode("OK");
    }
    else {
        echo json_encode("Failed");
    }
}

// Student Login Verification
if (!isset($_SESSION['is_login'])) {
    
      
    if (isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass'])) {
        $stuLogEmail = $_POST['stuLogEmail'];
        $stuLogPass = $_POST['stuLogPass'];

        $sql = "SELECT stu_email, stu_pass FROM student WHERE stu_email = '".$stuLogEmail."'";
        $result = $conn->query($sql);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['stu_pass'];
            // Hash the entered password and compare it with the stored hashed password
            if (password_verify($stuLogPass,  $hashed_password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['stuLogEmail'] = $stuLogEmail;
               echo json_encode(1); // Successful login
               
            } else {
                echo json_encode(0); // Invalid password
                
            }
        } else {
            echo json_encode(0); // User does not exist
        }
    }
}
?>