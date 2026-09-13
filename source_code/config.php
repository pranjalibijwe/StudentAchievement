<?php

$host = "sql202.infinityfree.com";
$username = "if0_42712325";
$password = "MYSQL_Password";
$database = "if0_42712325_student_achievement";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection is currently unavailable.");
}

mysqli_set_charset($conn, "utf8mb4");

?>