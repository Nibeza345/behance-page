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

header('Content-type: application/json');
// Get signup data
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Insert the user into the database
$sql = "INSERT INTO project1(username, email, password) VALUES('$username', '$email', '$password')";
$result= mysqli_query($conn , $sql);

if ($result) {
  echo json_encode("successful");
} else {
    echo  json_encode("failed");
//   echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>