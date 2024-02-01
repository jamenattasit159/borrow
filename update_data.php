<?php
// update_data.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to your database (use your own connection code)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "borrow";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $uid = $_POST['uid'];
    $status = $_POST['status'];

    // Update data in the database
    $sql = "UPDATE users SET status = '$status' WHERE uid = '$uid'";

    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
