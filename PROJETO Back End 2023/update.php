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

// Get the username and new password from the query string
$username = $_GET['username'];
$newPassword = $_GET['newpassword'];

// SQL query to update password
$sql = "UPDATE usuarios SET senha = '$newPassword' WHERE login = '$username'";

if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

// Close connection
$conn->close();
?>