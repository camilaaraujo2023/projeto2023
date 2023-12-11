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

// Get the username from the query string
$username = $_GET['username'];

// SQL query to select user(s)
if ($username == 'all') {
    $sql = "SELECT * FROM usuarios";
} else {
    $sql = "SELECT * FROM usuarios WHERE login = '$username'";
}

$result = $conn->query($sql);

$rows = array();
if ($result->num_rows > 0) {
    // Fetch associative array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} else {
    $rows[] = array("No results found");
}

// Close connection
$conn->close();

// Return data as JSON
echo json_encode($rows);

?>