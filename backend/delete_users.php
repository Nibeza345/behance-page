<?php
// Database connection
$host = 'localhost';
$db = 'user';
$user = 'root';
$password = '';

// Check if IDs are provided
if (isset($_POST['ids']) && is_array($_POST['ids']) && count($_POST['ids']) > 0) {
    $ids = $_POST['ids'];

    // Create a prepared statement to delete users
    $conn = new mysqli($host, $user, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "DELETE FROM project1 WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Users deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No user IDs provided.";
}
?>
