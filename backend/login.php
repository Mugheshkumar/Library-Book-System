<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

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

// Check if the form data is set
if (isset($_POST['username']) && isset($_POST['studentId']) && isset($_POST['password'])) {
    // Get the form data
    $username = $_POST['username'];
    $ID = $_POST['studentId'];
    $password = $_POST['password'];

    // Verify the user credentials
    $sql = "SELECT * FROM user WHERE studentName = ? AND studentId = ? AND studentPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $ID, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set the session variables
        $_SESSION['username'] = $username;
        $_SESSION['studentId'] = $ID;
        $_SESSION['loggedIn'] = true;

        // Redirect to the protected page
        header("Location: ../FrontEnd/redeem.php");
        echo "success";
    } else {
        // Display an error message
        echo "Invalid email or password";
    }
}

// Close the database connection
$conn->close();
?>