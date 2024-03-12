<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

header('Content-type: application/json');

$username = $_POST['username'];
echo $username;
$email = $_POST['email'];
echo $email;
$password = $_POST['password'];
echo $password;

$sql = "UPDATE project1 SET username = $username, email = $email, password = $password";
$result= mysqli_query($conn , $sql);

if ($result) {
  echo json_encode("successful");
} else {
    echo  json_encode("failed");

}

$conn->close();
?>