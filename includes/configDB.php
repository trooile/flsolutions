<?php
$servername = "localhost";
$username = "root";
//$password = "";
$password = "FelipeFLSolutions";
$dbname = "college_tool";
header("Content-type: text/html; charset=utf-8"); 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>