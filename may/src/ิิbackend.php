<?php
require_once 'connect.php';

$query = $conn->prepare("SELECT * FROM users");
if ($query->execute() === false) {
    die('Error executing the query');
}

$data = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
?>