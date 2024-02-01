<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    // รับค่า recid และข้อมูลที่ต้องการอัปเดต
    $recid = $_POST['recid'];
    $field1 = $_POST['field1'];
    // รับค่า input fields อื่น ๆ ตามต้องการ

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูล
    $sql = "UPDATE recover SET field1='$field1' WHERE recid=$recid";

    // ทำการอัปเดตข้อมูล
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
} else {
    echo "Invalid request";
}
?>
