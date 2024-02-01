<?php
// ต้องการให้ล็อกอินเข้าถึงฐานข้อมูล
// และตรวจสอบว่ามีค่า pid ที่ถูกส่งมาจาก AJAX หรือไม่
if (isset($_GET['inid'])) {
    $inid = $_GET['inid'];

    try {
        // Assuming $conn is your PDO connection
        $deleteQuery = $conn->prepare("DELETE FROM installment WHERE inid = :inid");
        $deleteQuery->bindParam(':inid', $inid, PDO::PARAM_INT);
        
        if ($deleteQuery->execute() === false) {
            die('Error executing the delete query');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
