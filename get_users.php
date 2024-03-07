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

// Fetch the total number of users
// $sql = "SELECT COUNT(*) as total FROM project1";
// $result = $conn->query($sql);
// $totalUsers = $result->fetch_assoc()['total'];

// Calculate the total number of pages
// $usersPerPage = 5; // Change this value to the desired number of users per page
// $totalPages = ceil($totalUsers / $usersPerPage);

// Get the current page from the request
// $page = $_GET['page'] ?? 1;
// $page = max(1, min($page, $totalPages));

// Calculate the offset for pagination
// $offset = ($page - 1) * $usersPerPage;

// Fetch users for the current page
// $sql = "SELECT * FROM project1 LIMIT $offset, $usersPerPage";
// $result = $conn->query($sql);

// if($result -> num-rows > 0){

// }
// $response = [
//   'users' => [],
//   'totalPages' => $totalPages
// ];

// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $user = [
//       'id' => $row['id'],
//       'name' => $row['name'],
//       'email' => $row['email']
//     ];
//     $response['users'][] = $user;
//   }
// }

// echo json_encode($response);

header('Content-Type: application/json');

$query = "SELECT * FROM project1";
$result = mysqli_query($conn, $query);

$users = array();
 while($row =$result->fetch_assoc())
   $users = $row;

   echo json_encode($users);

$conn->close();
?>