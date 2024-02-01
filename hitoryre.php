<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->execute([$uid]);
    $data = $stmt->fetch();
} else {
    $data = null;
}

// ตรวจสอบว่าไม่มีค่า $data หรือไม่
if (!$data) {
    echo "ไม่พบข้อมูลสำหรับ uid ที่ระบุ";
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sty.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="info.js"></script>
    <style>
        .custom-container {
            max-width: 1200px;
            /* กำหนดความกว้างสูงสุดของ container */
            margin: 0 auto;
            /* จัดตำแหน่ง container ตรงกลางของหน้าจอ */
            background-color: darkgray;
            padding: 20px;
            /* กำหนดระยะห่างภายใน container */

            /* กำหนดสีพื้นหลังของ container */
            border-radius: 8px;
            /* กำหนดขอบมนเพื่อให้มีเส้นขอบโค้ง */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* เงาบน container */
        }
    </style>
    <title>Edit Page</title>
</head>

<body>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="index.php">Homepage </a></li>
                    <li><a>Portfolio</a></li>
                    <li><a>About</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost text-xl">ประวัตการขอกู้</a>
        </div>
        <div class="navbar-end">
            <button class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            <button class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </button>
        </div>
    </div>

    <br>
    <div class="mockup-code custom-container">
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>รหัสประจำตัว</th>
                        <th>ชื่อ</th>
                        <th>ยอดกู้</th>
                        <th>ดอกเบีย</th>
                        <th>วันครบกำหนด</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Use $pdo to execute queries and fetch data
                    if (!empty($data)) {
                        require_once 'connect.php';

                        $query = $conn->prepare("SELECT 
                    a.uid AS user_uid,
                    a.pid,
                    a.fname,
                    a.cardid,
                    b.uid AS address_uid,
                    b.loan_amount,
                    b.interest_rate,
                    b.recovery_date,
                    b.stna,
                    b.recid
                FROM users AS a
                LEFT JOIN recover AS b ON a.uid = b.uid
                where 
                 b.stna = 'pass'and a.uid = :uid");
                        $query->bindParam(":uid", $uid, PDO::PARAM_INT);

                        if ($query->execute() === false) {
                            die('Error executing the query');
                        }

                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                            echo '<tr>';
                            echo '<td>' . $row['pid'] . '</td>';
                            echo '<td>' . $row['fname'] . '</td>';
                            echo '<td>' . $row['loan_amount'] . '</td>';
                            echo '<td>' . $row['interest_rate'] . '</td>';
                            echo '<td>' . $row['recovery_date'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">ไม่พบข้อมูล</td></tr>';
                    }
                    ?>
                </tbody>

            </table>

        </div>
    </div>
    <br><br><br><br>
    <div class="btm-nav">
        <a href="index.php"> <button class="text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </button></a>
        <button class="text-primary active">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
        <a href="eiei.php"> <button class="text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </button></a>
    </div>
</body>


</html>