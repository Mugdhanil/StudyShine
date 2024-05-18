<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "lms_db";
$port = 3306; // Specify the port number here

//Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $port);
//check Connection
if ($conn->connect_error) {
    die("Connection Failed");
}

/*
$db_host = "lms-db1.c56q0i4kekhs.ap-northeast-1.rds.amazonaws.com";
$db_user = "admin";
$db_password = "admin123";
$db_name = "lms_db";
$port = 3306; // Specify the port number here

//Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $port);
//check Connection
if ($conn->connect_error) {
    die("Connection Failed");
}*/

