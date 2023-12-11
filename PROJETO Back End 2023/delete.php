<?php
// Replace these database connection details with your actual credentials
$host = "localhost";
$user = "root";
$pass = "";
$db = "projeto_backend";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username to delete from the query string
$usernameToDelete = $_GET['username'];

// SQL query to delete user
$sql = "DELETE FROM usuarios WHERE id = '$usernameToDelete'";

if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error deleting user: " . $conn->error;
}

// Close connection
$conn->close();
?>