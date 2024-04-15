<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_booking";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST['username'];
$ID = $_POST['studentId'];
$password = $_POST['password'];

// Verify the user credentials
$sql = "SELECT * FROM user WHERE studentName = '$username' AND studentId = '$ID' AND studentPassword = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirect to the protected page
    header("Location: redeem.html");
    echo "success";
} else {
    // Display an error message
    echo "Invalid email or password";
}

$conn->close();
?>