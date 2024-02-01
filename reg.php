<?php
session_start();
require_once 'connect.php';
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $role = 'admin';

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: reg.php ");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: reg.php ");
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'รหัสต้องมีความยาว 5-20 ตัว';
        header("location: reg.php ");
    } else if (empty($c_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: reg.php ");
    } else if ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: reg.php ");
    } else {
        try {
            $check_user = $conn->prepare("SELECT username FROM admins WHERE username = :username");
            $check_user->bindParam(":username", $username);
            $check_user->execute();
            $row = $check_user->fetch(PDO::FETCH_ASSOC);
            if ($row['username'] == $username) {
                $_SESSION['warning'] = "มีอีเมลอยู่ในระบบแล้ว <a href='signin.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: reg.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO admins (username, password, role)
            VALUES(:username,  :password, :role)");
                $stmt->bindParam(":username", $username);
                
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":role", $role);
                $stmt->execute();
                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='signin.php' class='alert-link'>Click</a> เพื่อเข้าสู่ระบบ";
                header("location: reg.php ");
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: reg.php ");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>reg</title>
</head>

<body>
    <div class="container" style="background-color :beige">
        <h3 class="mt-5">สมัครสมาชิก</h3>
        <hr>
        <form method="post">

            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" name="username" aria-describedby="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm password" class="form-label">confirm password</label>
                <input type="password" class="form-control" name="c_password">
            </div>

            <button type="submit" name="signup" class="w3-button w3-red">Sign up</button>
        </form>
        <hr>
        <p>เป็นสามาชิกแล้วใช่ไหม<a href="signin.php">click เข้าสู่ระบบ</a></p>
    </div>
</body>

</html>