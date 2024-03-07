<?php
// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the user ID to be deleted
$userId = $_POST['id'];

// Delete the user from the database
$sql = "DELETE FROM project1 WHERE id = '$userId'";
if ($conn->query($sql) === TRUE) {
  echo "User deleted successfully";
} else {
  echo "Error deleting user: " . $conn->error;
}

$conn->close();
?>