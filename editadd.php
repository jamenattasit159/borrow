<?php
require_once 'connect.php';
// ตรวจสอบว่ามีการระบุ uid ใน URL หรือไม่
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    // ตรวจสอบว่ามีการส่งค่า POST มาหรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // รับค่าที่ส่งมาจากฟอร์ม
        $uid = $_POST['uid'];
        $address_line1 = $_POST['address_line1'];
        $address_line2 = $_POST['address_line2'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postal_code = $_POST['postal_code'];
        // เพิ่มฟิลด์อื่น ๆ ตามต้องการ

        // ทำการอัปเดตข้อมูล
        $query = "UPDATE address_records SET address_line1 = :address_line1, address_line2 = :address_line2, city = :city, province = :province, postal_code = :postal_code WHERE uid = :uid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':address_line1', $address_line1, PDO::PARAM_STR);
        $stmt->bindParam(':address_line2', $address_line2, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':province', $province, PDO::PARAM_STR);
        $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

        // ทำการ execute คำสั่ง SQL
        if ($stmt->execute()) {
            echo "Update successful";
        } else {
            echo "Update failed: " . implode(", ", $stmt->errorInfo());
        }
    }

}
?>