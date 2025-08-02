<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";    
$password = "";         
$dbname = "hack";


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password


$sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $password);

if ($stmt->execute()) {
    
    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
