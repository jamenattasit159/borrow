<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่า uid จาก Ajax
    $recid = $_POST['recid'];

    // ทำการอัพเดทค่าในฐานข้อมูล
    $updateQuery = $conn->prepare("UPDATE recover SET stna = 'pass' WHERE recid = :recid");
    $updateQuery->bindParam(':recid', $recid, PDO::PARAM_INT);

    if ($updateQuery->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>