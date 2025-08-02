<?php
require_once 'connection.php';


// Handle photo upload
// $photoName = "";
// if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
//     $uploadDir = "uploads/";
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0777, true);
//     }
//     $photoName = basename($_FILES["photo"]["name"]);
//     $targetPath = $uploadDir . $photoName;
//     move_uploaded_file($_FILES["photo"]["tmp_name"], $targetPath);
// }

// Sanitize and insert data
$fullname = $conn->real_escape_string($_POST["fullname"]);
$email    = $conn->real_escape_string($_POST["email"]);
$phone    = $_POST["phone"];
$location = $conn->real_escape_string($_POST["location"]);
$sql = "INSERT INTO details 
        ( fullname, email, phone, location) 
        VALUES 
        ('$fullname', '$email', '$phone', '$location')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    header("Location: index.php");
    // echo "<h2 style='color:green;'>Data saved! Your ID is: $last_id</h2>";
    // echo "<a href='index.html'>Go to Home</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
