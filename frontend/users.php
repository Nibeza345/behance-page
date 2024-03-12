<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/styles.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
  <style>
    table{
      border-collapse: collapse;
      width: 50%;
      height: 2rem;
    }
    tr,
    th,
    td {
      height: 2.5rem;
      border: 1px solid black;
      padding: 1rem;

    }
    #search-input {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>

  <h1>All Users</h1>
  <input type="text" id="search-input" placeholder="Search...">
  <table id="users-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Password</th>
      <th>Select</th>
    </tr>
  </thead>
  <tbody>
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

  // Pagination configuration
  $resultsPerPage = 4;
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($currentPage - 1) * $resultsPerPage;

  // Retrieve user data from the 'project1' table with pagination
  $sql = "SELECT * FROM project1 LIMIT $offset, $resultsPerPage";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['password'] . "</td>";
      echo "<td><input type='checkbox' class='user-checkbox' data-id='" . $row['id'] . "'></td>";
      echo "<td><button class='edit-button'>Edit</button></td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='2'>No users found.</td></tr>";
  }

  $conn->close();


?>

  </tbody>
</table>
<?php
    // Retrieve total number of rows from the 'project1' table
    $conn = new mysqli($host, $user, $password, $db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) AS total FROM project1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalRows = $row['total'];

    // Calculate total number of pages
    $totalPages = ceil($totalRows / $resultsPerPage);

    // Display pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
      echo "<a href='users.php?page=$i'>$i</a>";
    }
    echo "</div>";
    ?>
<div id="pagination"></div>
  
  <button id="delete-btn">Delete</button>
  <!-- Update your HTML form to include an input field for user ID -->
<form id="edit-form">
    <input type="hidden" id="edit-id" name="edit-id">
    <label for="edit-name">Username:</label>
    <input type="text" id="edit-name" name="edit-name" required>
    <label for="edit-email">Email:</label>
    <input type="email" name="edit-email" id="edit-email" required>
    <label for="edit-password">Password:</label>
    <input type="password" id="edit-password" name="edit-password" required>
    <button type="submit" id="save">Save</button>
</form>

  <script src="../js/users.js"></script>
</body>

</html>