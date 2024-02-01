<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
require_once 'connect.php';

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT COUNT(uid) AS total_users,
        COUNT(CASE WHEN status = 'pass' THEN 1 END) AS pass_u,
        COUNT(CASE WHEN status = 'fail' THEN 1 END) AS fall_u,
        COUNT(CASE WHEN status = 'two' THEN 1 END) AS two_u
        FROM users";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $totalUsers = $row['total_users'];

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;

    // สร้างข้อมูล JSON
    $data = array(
        "totalUsers" => $totalUsers,
        "pass_u" => $row['pass_u'],
        "fall_u" => $row['fall_u'],
        "two_u" => $row['two_u']
    );

    // ส่งข้อมูล JSON กลับ
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "Error executing query: " . $conn->error;
}

?>
