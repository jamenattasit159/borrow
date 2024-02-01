<?php

// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "borrow";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from your table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check for errors
if ($result === false) {
    echo json_encode(['error' => $conn->error]);
} else {
    // Fetch the data and store it in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
}


// Close the connection
$conn->close();

?>