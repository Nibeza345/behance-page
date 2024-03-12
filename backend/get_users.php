<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


header('Content-Type: application/json');

$query = "SELECT * FROM project1";
$result = mysqli_query($conn, $query);

$users = array();
 while($row =$result->fetch_assoc())
   $users[] = $row;
  echo json_encode($users);


$conn->close();
?>