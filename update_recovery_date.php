<?php
// Assuming you have a database connection established
require_once 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recid = $_POST['recid']; // Change the variable name

    // Update recovery_date by adding 7 days
    $query = $conn->prepare("UPDATE recover SET recovery_date = DATE_ADD(recovery_date, INTERVAL 7 DAY) WHERE recid = :recid");
    $query->bindParam(':recid', $recid, PDO::PARAM_INT);
    if ($query->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request';
}
?>