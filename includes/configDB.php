<?php
$servername = "10.158.0.7";
$username = "root";
$password = "FelipeComanda";
$dbname = "college_tool";
header("Content-type: text/html; charset=utf-8"); 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>