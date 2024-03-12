<?php
// Database connection
$host = 'localhost';
$db = 'user';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$id = $_POST['edit-id'];
$username = $_POST['edit-name'];
$email = $_POST['edit-email'];
$password = $_POST['edit-password'];

// Update the user record in the database
$sql = "UPDATE project1 SET username='$username', email='$email', password='$password' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "User updated successfully";
} else {
    echo "Error updating user: " . $conn->error;
}

$conn->close();
?>
