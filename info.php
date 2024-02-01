<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $stmt = $conn->query("select * from users where uid = $uid");
    $stmt->execute();
    $data = $stmt->fetch();
}
?>

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
    <title>Document</title>

</head>

<body>

    <dialog id="my_modal_4" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">เพิ่มข้อมูลที่อยู่!</h3>

            <form class="card-body" method="post" action="insert_address.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">บ้านเลขที่</span>
                    </label>
                    <input type="text" placeholder="กรอกบ้านเลขที่" class="input input-bordered" name="address_line1"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ตำบล</span>
                    </label>
                    <input type="text" placeholder="กรอกตำบล" class="input input-bordered" name="address_line2"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">อำเภอ</span>
                    </label>
                    <input type="text" placeholder="กรอกอำเภอ" class="input input-bordered" name="city" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">จังหวัด</span>
                    </label>
                    <input type="text" placeholder="กรอกจังหวัด" class="input input-bordered" name="province"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">รหัสไปษณี</span>
                    </label>
                    <input type="text" placeholder="กรอกรหัสไปษณี" class="input input-bordered" name="postal_code"
                        required />
                </div>

                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">

                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
    <dialog id="my_modal_5" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">เพิ่มข้อมูลยอดกู้!</h3>

            <form class="card-body" method="post" action="insert_recover.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ยอดกู้</span>
                    </label>
                    <input type="text" placeholder="กรอกยอดกู้" class="input input-bordered" name="loan_amount"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ดอกเบีย</span>
                    </label>
                    <input type="text" placeholder="กรอกดอกเบีย" class="input input-bordered" name="interest_rate"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">วันที่ส่งยอด</span>
                    </label>
                    <input type="date" placeholder="กรอกวันที่ส่งยอด" class="input input-bordered" name="recovery_date"
                        required />
                </div>
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
    <dialog id="my_modal_editre" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">เพิ่มข้อมูลยอดกู้!</h3>

            <form class="card-body" method="post" action="insert_recover.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ยอดกู้</span>
                    </label>
                    <input type="text" placeholder="กรอกยอดกู้" class="input input-bordered" name="loan_amount"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ดอกเบีย</span>
                    </label>
                    <input type="text" placeholder="กรอกดอกเบีย" class="input input-bordered" name="interest_rate"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">วันที่ส่งยอด</span>
                    </label>
                    <input type="date" placeholder="กรอกวันที่ส่งยอด" class="input input-bordered" name="recovery_date"
                        required />
                </div>
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
    <dialog id="my_modal_6" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">เพิ่มข้อมูลรายวัน!</h3>

            <form class="card-body" method="post" action="insert_in.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ชื่อสินค้า</span>
                    </label>
                    <input type="text" placeholder="กรอกชื่อสินค้า" class="input input-bordered" name="product_name"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ราคา</span>
                    </label>
                    <input type="text" placeholder="กรอกราคา" class="input input-bordered" name="price" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">วันที่ส่งยอด</span>
                    </label>
                    <input type="date" placeholder="กรอกวันที่ส่งยอด" class="input input-bordered" name="purchase_date"
                        required />
                </div>
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
    <dialog id="my_modal_7" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">เพิ่มข้อมูลรายเดือน!</h3>

            <form class="card-body" method="post" action="insert_inmount.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ชื่อสินค้า</span>
                    </label>
                    <input type="text" placeholder="กรอกชื่อสินค้า" class="input input-bordered" name="product_name"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ราคา</span>
                    </label>
                    <input type="text" placeholder="กรอกราคา" class="input input-bordered" name="price" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">วันที่ส่งยอด</span>
                    </label>
                    <input type="date" placeholder="กรอกวันที่ส่งยอด" class="input input-bordered" name="purchase_mount"
                        required />
                </div>
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
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
            <a class="btn btn-ghost text-xl">
                <?php echo 'ID: ' . $uid; ?>
            </a>

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

    <div class="container">
        <center>
            <h1>รายละเอียด</h1>
        </center>
        <button class="btn btn-active btn-primary" onclick="my_modal_4.showModal()">เพิ่มข้อมูล</button>
        <button class="btn btn-active btn-primary" onclick="edit.showModal()">แก้ไขข้อมูล</button><br><br>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>รหัสประจำตัว</th>
                        <th>ชื่อ</th>
                        <th>เลขบัตร</th>
                        <th>บ้านเลขที่</th>
                        <th>ตำบล</th>
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th>รหัสไปษณี</th>
                    </tr>
                </thead>
                <tbody id="userDataBody">
                    <?php
                    // Use $pdo to execute queries and fetch data
                    $query = $conn->prepare("SELECT 
                    a.uid AS user_uid,
                    a.pid,
                    a.fname,
                    a.cardid,
                    b.uid AS address_uid,
                    b.address_line1,
                    b.address_line2,
                    b.city,
                    b.province,
                    b.postal_code
                FROM users AS a
                LEFT JOIN address_records AS b ON a.uid = b.uid
                WHERE a.uid = $uid;
                ");

                    if ($query->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['pid'] . '</td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['cardid'] . '</td>';
                        echo '<td>' . $row['address_line1'] . '</td>';
                        echo '<td>' . $row['address_line2'] . '</td>';
                        echo '<td>' . $row['city'] . '</td>';
                        echo '<td>' . $row['province'] . '</td>';
                        echo '<td>' . $row['postal_code'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>
            <?php
            require_once 'connect.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if POST data is set
                if (isset($_POST['uid'], $_POST['address_line1'], $_POST['address_line2'], $_POST['city'], $_POST['province'], $_POST['postal_code'])) {
                    // Sanitize input data
                    $uid = intval($_POST['uid']);
                    $address_line1 = htmlspecialchars($_POST['address_line1']);
                    $address_line2 = htmlspecialchars($_POST['address_line2']);
                    $city = htmlspecialchars($_POST['city']);
                    $province = htmlspecialchars($_POST['province']);
                    $postal_code = htmlspecialchars($_POST['postal_code']);

                    // Update data
                    $query = "UPDATE address_records SET address_line1 = :address_line1, address_line2 = :address_line2, city = :city, province = :province, postal_code = :postal_code WHERE uid = :uid";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':address_line1', $address_line1, PDO::PARAM_STR);
                    $stmt->bindParam(':address_line2', $address_line2, PDO::PARAM_STR);
                    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                    $stmt->bindParam(':province', $province, PDO::PARAM_STR);
                    $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
                    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

                    try {
                        $stmt->execute();

                        echo '<div role="alert" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Your purchase has been confirmed!</span>
                              </div>';

                        // Use JavaScript to redirect after a short delay with uid parameter
                        echo '<script>
                                setTimeout(function() {
                                    var uid = ' . json_encode($_GET['uid']) . ';
                                    window.location.href = "info.php?uid=" + uid;
                                }, 2000); 
                              </script>';
                    } catch (PDOException $e) {
                        echo '<div role="alert" class="alert alert-error">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Error! Task failed successfully.</span>
                              </div>';
                    }
                }
            } elseif (isset($_GET['uid'])) {
                // Fetch user data for the form
                $uid = $_GET['uid'];
                $query = $conn->prepare("SELECT * FROM users as a LEFT JOIN address_records as b ON a.uid = b.uid WHERE a.uid = :uid");
                $query->bindParam(':uid', $uid, PDO::PARAM_INT);
                $query->execute();

                if ($query->rowCount() > 0) {
                    $row = $query->fetch(PDO::FETCH_ASSOC);

                    // Display the form
                    echo '<dialog id="edit" class="modal">';

                    echo '    <div class="modal-box w-11/12 max-w-2xl">';
                    echo ' <form method="dialog">';
                    echo '<button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>';
                    echo '   </form>';
                    echo '        <form method="post" action="">'; // <- Empty action attribute
                    // echo '            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>';
                    echo '            <h3 class="font-bold text-lg">แก้ไขข้อมูล!</h3>';
                    echo ' <div class="form-control">';
                    echo '            <label for="province">บ้านเลขที่:</label>';
                    echo '            <input type="text" name="address_line1" class="input input-bordered " value="' . htmlspecialchars($row['address_line1']) . '"><br>';
                    echo '            <label for="address_line2">ตำบล:</label>';
                    echo '            <input type="text" name="address_line2" class="input input-bordered" value="' . htmlspecialchars($row['address_line2']) . '"><br>';
                    echo '            <label for="city">อำเภอ:</label>';
                    echo '            <input type="text" name="city" class="input input-bordered" value="' . htmlspecialchars($row['city']) . '"><br>';
                    echo '            <label for="province">จังหวัด:</label>';
                    echo '            <input type="text" name="province" class="input input-bordered" value="' . htmlspecialchars($row['province']) . '"><br>';
                    echo '            <label for="postal_code">รหัสไปษณี:</label>';
                    echo '            <input type="text" name="postal_code" class="input input-bordered" value="' . htmlspecialchars($row['postal_code']) . '"><br>';
                    echo '            <input type="hidden" name="uid" value="' . $uid . '">';
                    echo '            <button class="btn btn-primary">บันทึก</button>';
                    echo '        </form>';
                    echo '    </div>';
                    echo '</dialog>';
                } else {
                    echo "No data found for the specified UID.";
                }
            } else {
                echo "Invalid request.";
            }
            ?>
            <!-- <div class="form-control">
                    <label class="label">
                        <span class="label-text">บ้านเลขที่</span>
                    </label>
                    <input type="text" placeholder="กรอกบ้านเลขที่" class="input input-bordered" name="address_line1"
                        required />
                </div> -->
        </div>
    </div>

    <br><br>
    <div class="container">
        <center>
            <h1>ยอดกู้</h1>
        </center>
        <button class="btn btn-active btn-primary" onclick="my_modal_5.showModal()">เพิ่มข้อมูล</button>
        <form action="hitoryre.php" method="get">
            <input type="hidden" name="uid" value="<?= $uid ?>">
            <button type="submit" class="btn btn-active btn-primary">ประวัติ</button>
        </form>

        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>รหัสประจำตัว</th>
                        <th>ชื่อ</th>
                        <th>ยอดกู้</th>
                        <th>ดอกเบีย</th>
                        <th>วันครบกำหนด</th>
                        <th>เพิ่มวัน</th>
                        <th>ยืนยัน</th>
                        <th>ลบ</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Use $pdo to execute queries and fetch data
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
                WHERE a.uid = $uid;");

                    if ($query->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['stna'] == 'pass') {
                            continue;
                        }
                        echo '<tr>';
                        echo '<td>' . $row['pid'] . '</td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['loan_amount'] . '</td>';

                        // Check if recovery_date is reached and loan_amount has a value
                        if (!empty($row['loan_amount']) && strtotime($row['recovery_date'] . ' +1 day') <= strtotime(date('Y-m-d'))) {
                            // Calculate the number of days passed since the recovery date
                            $recoveryDate = new DateTime($row['recovery_date']);
                            $currentDate = new DateTime(date('Y-m-d'));
                            $daysPassed = $currentDate->diff($recoveryDate)->days;

                            // Add 100 for each day passed
                            $row['interest_rate'] += $daysPassed * 100;
                        }


                        echo '<td>' . $row['interest_rate'] . '</td>';
                        if ($row['stna'] == 'pass') {
                            echo '<td>ส่งครบแล้ว</td>';
                        } else {
                            echo '<td>' . $row['recovery_date'] . '</td>';
                        }
                        // Button 1: Add 7 days to recovery_date
                        echo '<td><button class="btn btn-warning add-days-btn" data-recid="' . $row['recid'] . '">เพิ่มวัน</button></td>';
                        echo '<td><button class="btn btn-success save-btn" data-recid="' . $row['recid'] . '">ส่งครบ</button></td>';
                        echo '<td><button class="btn btn-active btn-primary" onclick="openEditPage(' . $row['recid'] . ', \'' . $row['user_uid'] . '\')">แก้ไขข้อมูล</button>';

                        echo '<button class="btn btn-error delete-btn" data-recid="' . $row['recid'] . '" data-user-uid="' . $row['user_uid'] . '">Delete</button>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>

        </div>

    </div>
    <br><br>
    <div class="container">
        <center>
            <h1>ยอดผ่อนของ</h1>
        </center>
        <button class="btn btn-active btn-primary" onclick="my_modal_6.showModal()">เพิ่มข้อมูลรายวัน</button>
        <button class="btn btn-active btn-primary" onclick="my_modal_7.showModal()">เพิ่มข้อมูลรายเดือน</button>
        <form action="historyin.php" method="get">
            <input type="hidden" name="uid" value="<?= $uid ?>">
            <button type="submit" class="btn btn-active btn-primary">ประวัติ</button>
        </form><br><br>
        <div class="mockup-window border bg-base-300">

            <div class="flex justify-center px-4 py-16 bg-base-200">

                <?php
                try {
                    // Assuming $conn is your PDO connection
                    $query = $conn->prepare("SELECT *
        FROM 
        installment AS b 
        LEFT JOIN users AS a ON b.uid = a.uid
        WHERE b.uid = $uid");

                    if ($query->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['purchase_date'] == '0000-00-00') {
                            continue;
                        }
                        if ($row['instatus'] == 'pass') {
                            continue;
                        }
                        // Generate a unique ID for each card using inid (primary key)
                        $cardId = 'card' . $row['inid'];

                        echo '<div class="slider owl-carousel" id="' . $cardId . '">';
                        echo ' <div class="card">';
                        echo '    <div class="content">';
                        echo '      <div class="title">';
                        echo '<p>รหัส: ' . $row['inid'] . '';
                        echo '      </div>';
                        echo '     <div class="sub-title">';
                        echo '  ชื่อ: ' . $row['fname'] . '</p>';
                        echo '     </div>';
                        echo '<h2>รายละเอียดการผ่อนจ่าย</h2>';
                        echo '<p>สินค้า: ' . $row['product_name'] . ' ยอด:' . $row['price'] . ' </p>';

                        echo '<div class="installment-info">';
                        for ($i = 1; $i <= 8; $i++) {
                            $purchaseDate = $row['purchase_date'];
                            $newDate = date('Y-m-d', strtotime($purchaseDate . ' + ' . (($i - 1) * 7) . ' days'));

                            // Add the checkbox and a unique identifier for each checkbox
                            $checkboxId = 'installment_daily' . $row['inid'] . '_' . $i;
                            echo '<p id="' . $checkboxId . '">';
                            echo 'วันที่รอบจ่าย: ' . $i . ': ' . $newDate;
                            echo '<button onclick="changeColor(' . $row['inid'] . ', ' . $i . ', \'daily\')">ยืนยัน</button>';
                            echo '</p>';
                        }

                        echo '</div>';
                        echo '<button class="btn btn-success savein-btn" data-inid="' . $row['inid'] . '">ส่งครบ</button>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<script>';
                        echo 'function changeColor(inid, installmentIndex, type) {';
                        echo '  var elementId = "installment_" + type + inid + "_" + installmentIndex;';
                        echo '  var element = document.getElementById(elementId);';
                        echo '  if (element.style.backgroundColor === "green") {';
                        echo '    element.style.backgroundColor = "";';
                        echo '    localStorage.removeItem(elementId);';
                        echo '  } else {';
                        echo '    element.style.backgroundColor = "green";';
                        echo '    localStorage.setItem(elementId, "green");';
                        echo '  }';
                        echo '}';
                        echo '</script>';
                        echo '<script>';
                        echo 'document.addEventListener("DOMContentLoaded", function() {';
                        echo '  localStorage.setItem("exampleId", "green");';
                        echo '  var colorState = localStorage;';
                        echo '  for (var key in colorState) {';
                        echo '    var element = document.getElementById(key);';
                        echo '    if (element) {';
                        echo '      element.style.backgroundColor = colorState[key];';
                        echo '    }';
                        echo '  }';
                        echo '});';
                        echo '</script>';

                        // Separate each card with a horizontal line or any other HTML element as needed
                        echo '<hr>';
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                ?>

                <?php
                try {
                    // Assuming $conn is your PDO connection
                    $query = $conn->prepare("SELECT a.uid,a.fname,a.cardid,a.pid,b.inid,b.product_name,b.price,b.uid,b.purchase_mount,b.instatus,b.mountstatus
                        FROM 
                         installment AS b 
                          LEFT JOIN users AS a ON b.uid = a.uid
                      WHERE  b.uid = $uid");

                    if ($query->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        // Skip the card if purchase_mount is '0000-00-00'
                        if ($row['purchase_mount'] == '0000-00-00') {
                            continue;
                        }
                        if ($row['mountstatus'] == 'pass') {
                            continue;
                        }
                        echo '<div class="slider owl-carousel" id="card' . $row['uid'] . '">';
                        echo ' <div class="card">';


                        echo '    <div class="content">';
                        echo '      <div class="title">';
                        echo '<p>รหัส: ' . $row['inid'] . '';
                        echo '      </div>';
                        echo '     <div class="sub-title">';
                        echo '  ชื่อ: ' . $row['fname'] . '</p>';
                        echo '     </div>';
                        // Display user information
                

                        // Add more user-related information as needed
                
                        echo '<h2>รายละเอียดการผ่อนจ่าย</h2>';
                        echo '<p>สินค้า: ' . $row['product_name'] . ' ยอด:' . $row['price'] . ' </p>';

                        echo '<div class="installment-info">';
                        for ($i = 1; $i <= 2; $i++) {
                            $purchaseMount = $row['purchase_mount'];
                            $newmount = date('Y-m-d', strtotime($purchaseMount . ' + ' . (($i - 1) * 31) . ' days'));

                            // Add the checkbox and a unique identifier (e.g., installment ID) for each checkbox
                            echo '<p id="installment_monthly' . $row['uid'] . '_' . $i . '">';
                            echo 'วันที่รอบจ่าย: ' . $i . ': ' . $newmount;
                            echo '<button onclick="changeColor(' . $row['uid'] . ', ' . $i . ', \'monthly\')">ยืนยัน</button>';
                            echo '</p>';

                        }

                        echo '</div>';

                        echo '<button class="btn btn-success savemount-btn" data-inid="' . $row['inid'] . '">ส่งครบ</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<script>';
                        echo 'function changeColor(uid, installmentIndex, type) {';
                        echo '  var elementId = "installment_" + type + uid + "_" + installmentIndex;';
                        echo '  var element = document.getElementById(elementId);';
                        echo '  if (element.style.backgroundColor === "green") {';
                        echo '    element.style.backgroundColor = "";';
                        echo '    localStorage.removeItem(elementId);';
                        echo '  } else {';
                        echo '    element.style.backgroundColor = "green";';
                        echo '    localStorage.setItem(elementId, "green");';
                        echo '  }';
                        echo '}';
                        echo '</script>';
                        echo '<script>';
                        echo 'document.addEventListener("DOMContentLoaded", function() {';
                        echo '  localStorage.setItem("exampleId", "green");';
                        echo '  var colorState = localStorage;';
                        echo '  for (var key in colorState) {';
                        echo '    var element = document.getElementById(key);';
                        echo '    if (element) {';
                        echo '      element.style.backgroundColor = colorState[key];';
                        echo '    }';
                        echo '  }';
                        echo '});';
                        echo '</script>';



                        // Separate each card with a horizontal line or any other HTML element as needed
                        echo '<hr>';
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>

    <br><br><br><br>
    <div class="btm-nav">
        <a href="index.php"><button class="text-primary  ">
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
        <button class="text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </button>
    </div>

    <!-- <script>
        // ตรวจสอบสถานะสีจากตัวแปร global และกำหนดสีตามนั้นเมื่อหน้าเว็บโหลด
        document.addEventListener("DOMContentLoaded", function () {
            for (var elementId in installmentColorState) {
                var element = document.getElementById(elementId);
                if (element) {
                    element.style.backgroundColor = "green";
                }
            }
        });
    </script> -->

</body>

</html>