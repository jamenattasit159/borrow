<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่า uid จาก Ajax
    $inid = $_POST['inid'];

    // ทำการอัพเดทค่าในฐานข้อมูล
    $updateQuery = $conn->prepare("UPDATE installment SET instatus = 'pass' WHERE inid = :inid");
    $updateQuery->bindParam(':inid', $inid, PDO::PARAM_INT);

    if ($updateQuery->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>