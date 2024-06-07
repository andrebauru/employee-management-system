<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "employee_management";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
