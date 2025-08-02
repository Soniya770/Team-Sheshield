<?php
$host = "localhost";
$user = "root";
$pass = "";  // default XAMPP password
$db   = "hack";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);
   
if($conn)
{
    echo "Connected successfully";
} else {
    die("Connection failed: " . $conn->connect_error);
}
