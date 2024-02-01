<?php
// delete_image.php

// เชื่อมต่อกับฐานข้อมูล (ปรับแต่งตามข้อมูลการเชื่อมต่อของคุณ)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "borrow";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่า img_id จากฟอร์ม
$img_id = $_POST['img_id'];
$uid = $_POST['uid'];

// สร้างคำสั่ง SQL เพื่อลบรูปภาพ
$sql = "DELETE FROM user_images WHERE image_id = $img_id";

// ทำการลบ
if ($conn->query($sql) === TRUE) {
    header("Location: edit.php?uid=" . $uid);
} else {
    echo "เกิดข้อผิดพลาดในการลบรูปภาพ: " . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
