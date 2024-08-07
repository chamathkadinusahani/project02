<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_example";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user inputs for security
$user = $conn->real_escape_string($_POST['username']);
$pass = $conn->real_escape_string($_POST['password']);

// Prepare and execute SQL query
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid username or password.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
