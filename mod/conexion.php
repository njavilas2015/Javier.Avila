<?php
$servername = "localhost";
$username = "Insert";
$password = "QAZ123wsx2018@";
$db_name = "insert_mendoza";

$conn = new mysqli($servername, $username, $password,$db_name);
if ($conn->connect_error) {
    $_SESSION['mensaje']='Check Connection failed:  '. $conn->connect_error;
} 

?>