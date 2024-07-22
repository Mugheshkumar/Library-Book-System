<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to the login page
    header("Location: ../FrontEnd/login.php");
    exit;
}
// Connect to your SQL Workbench database
$conn = mysqli_connect("localhost", "root", "", "library_booking", 3308);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the action parameter from the URL
$action = $_GET['action'];

if ($action == 'getPrizeData') {
  // Retrieve prize data
  $result = mysqli_query($conn, "SELECT * FROM prize_data");

  // Create an array to store the prize data
  $prizeData = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $prizeData[] = $row;
  }

  // Return the prize data in JSON format
  echo json_encode($prizeData);
} elseif ($action == 'redeemPoints') {
  // Handle redeem points action (TO DO: implement redeem points logic)
  // For now, just return a success message
  echo json_encode(array('success' => true));
} else {
  // Return an error message for unknown actions
  echo json_encode(array('error' => 'Unknown action'));
}

// Close the database connection
mysqli_close($conn);
?>