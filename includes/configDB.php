<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "college_tool";
header("Content-type: text/html; charset=utf-8"); 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>