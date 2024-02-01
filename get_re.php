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
    <title>Edit Page</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // เชื่อมต่อฐานข้อมูล
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "borrow";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบว่าเชื่อมต่อสำเร็จหรือไม่
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // รับค่า recid และข้อมูลที่ต้องการอัปเดต
        $recid = $_POST['recid'];
        $loan_amount = $_POST['loan_amount'];
        $interest_rate = $_POST['interest_rate'];
        $recovery_date = $_POST['recovery_date'];
        // $user_id = $_POST['user_id'];

        // รับค่า input fields อื่น ๆ ตามต้องการ
    
        // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูล
        $sql = "UPDATE recover SET loan_amount='$loan_amount', interest_rate='$interest_rate', recovery_date='$recovery_date' WHERE recid=$recid";

        // ทำการอัปเดตข้อมูล
        if ($conn->query($sql) === TRUE) {
            // echo "Data updated successfully";
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "แก้ไขให้และนะจ้ะ!",
                showConfirmButton: false,
                timer: 1500
            }).then(function () {
               
                window.location.href = "index.php" ;
            });
        </script>';
        } else {
            echo "Error updating data: " . $conn->error;
        }


        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
    } elseif (isset($_GET['recid'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "borrow";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบว่าเชื่อมต่อสำเร็จหรือไม่
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $recid = $_GET['recid'];

        // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากฐานข้อมูล
        $sql = "SELECT * FROM recover WHERE recid = $recid";
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // ปิดการเชื่อมต่อฐานข้อมูล
            $conn->close();
            ?>

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
                    <a class="btn btn-ghost text-xl">บันทึกกู้ยืม</a>
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
            <div class="mockup-code">
                <center>
                    <!-- แสดงข้อมูลที่ต้องการแก้ไข -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="recid" value="<?php echo $row['recid']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <!-- แสดงข้อมูลอื่น ๆ ที่ต้องการแก้ไข -->
                        <label for="loan_amount">ยอดกู้:</label>
                        <input type="text" class="input input-bordered input-warning w-full max-w-xs" name="loan_amount"
                            value="<?php echo $row['loan_amount']; ?>"><br><br>
                        <label for="interest_rate">ดอก:</label>
                        <input type="text" class="input input-bordered input-warning w-full max-w-xs" name="interest_rate"
                            value="<?php echo $row['interest_rate']; ?>"><br><br>
                        <label for="recovery_date">วันที่ส่ง:</label>
                        <input type="date" class="input input-bordered input-warning w-full max-w-xs" name="recovery_date"
                            value="<?php echo $row['recovery_date']; ?>"><br><br>

                        <!-- เพิ่ม input fields อื่น ๆ ตามต้องการ -->

                        <button type="submit"
                            class="btn btn-xs btn-outline btn-warning sm:btn-sm md:btn-md lg:btn-lg">บันทึก</button>
                    </form>
                </center>
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
        <?php
        } else {
            echo "No data found";
            $conn->close();
        }
    } else {
        echo "Invalid request";
    }
    ?>