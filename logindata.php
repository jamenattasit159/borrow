<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM admins WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            if (password_verify($password, $row['password'])) {
                if ($row['role'] == 'admin') {
                    $_SESSION['admin_login'] = $row['adid'];
                    header("location: index.php");
                }
            } else {
                $_SESSION['error'] = 'รหัสผ่านผิด';
                header("location: login.php");
            }
        } else {
            $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
            header("location: login.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>