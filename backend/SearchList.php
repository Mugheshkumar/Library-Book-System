<?php
session_start();


// Define database connection
$conn = mysqli_connect('localhost', 'root', '', 'library_booking', 3308);

if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}


// Get the search term from the URL parameter
$term = $_GET['term'];

// Query database
$sql = "SELECT idbook_card, Title, Author, Genre, Donor, image_link FROM book_card 
        WHERE Title LIKE '%$term%' OR Author LIKE '%$term%' OR Genre LIKE '%$term%'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: ". mysqli_error($conn));
}

// Fetch data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close database connection
mysqli_close($conn);

// Return data in JSON format
echo json_encode($data);
?>