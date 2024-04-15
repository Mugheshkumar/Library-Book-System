<?php
// login.php

// Include the database connection file
require_once 'login.php';

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the form data
if (empty($username) || empty($email) || empty($password)) {
  // Return an error message if any of the fields are empty
  $response = array('success' => false, 'message' => 'All fields are required.');
  echo json_encode($response);
  exit();
}

// Prepare and execute the SQL query to check if the user exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user was found
if ($result->num_rows > 0) {
  // Fetch the user data
  $user = $result->fetch_assoc();

  // Verify the password
  if (password_verify($password, $user['password'])) {
    // Set the session variables
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Return a success message
    $response = array('success' => true, 'message' => 'Login successful.');
    echo json_encode($response);
    exit();
  } else {
    // Return an error message if the password is incorrect
    $response = array('success' => false, 'message' => 'Invalid password.');
    echo json_encode($response);
    exit();
  }
} else {
  // Return an error message if the user was not found
  $response = array('success' => false, 'message' => 'User not found.');
  echo json_encode($response);
  exit();
}

// Close the database connection
$stmt->close();
$conn->close();
?>