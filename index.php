<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <title>Document</title>
</head>

<body>
    <!-- You can open the modal using ID.showModal() method -->

    <dialog id="my_modal_4" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Hello!</h3>

            <form class="card-body" method="post" action="insert_data.php">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">PID</span>
                    </label>
                    <input type="text" placeholder="กรอกรหัสสมาชิก" class="input input-bordered" name="pid" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ชื่อ</span>
                    </label>
                    <input type="text" placeholder="กรอกชิ้อ" class="input input-bordered" name="fname" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">นามสกุล</span>
                    </label>
                    <input type="text" placeholder="กรอกนามสกุล" class="input input-bordered" name="lname" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">ชื่อfacebook</span>
                    </label>
                    <input type="text" placeholder="กรอกfacebook" class="input input-bordered" name="facename"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">เลขบัตร</span>
                    </label>
                    <input type="text" placeholder="กรอกเลขบัตร" class="input input-bordered" name="cardid" required />
                </div>
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
           <a href="logout.php" ><button class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </button></a>
        </div>
    </div>

    <br>

    <center>
        <div class="stats stats-vertical lg:stats-horizontal shadow">

            <div class="stat" id="userall">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </div>
                <div class="stat-title text-info">สมาชิกทั้งหมด</div>
                <div class="stat-value text-primary"><span class="loading loading-infinity loading-lg"></span></div>
                <div class="stat-desc text-success">เจ๊ปราง</div>
            </div>

            <div class="stat" id="userrecover">
                <div class="stat-title text-info">จำนวนคนกู้</div>
                <div class="stat-value text-accent"><span class="loading loading-infinity loading-lg"></span>.</div>
                <div class="stat-desc text-success">↗︎ Loading...</div>
            </div>
            <div class="stat" id="userinstall">
                <div class="stat-title text-info">จำนวนคนผ่อน</div>
                <div class="stat-value text-secondary"><span class="loading loading-infinity loading-lg"></span></div>
                <div class="stat-desc text-success">↗︎ Loading...</div>
            </div>

            <div class="stat" id="userinandre">
                <div class="stat-title text-info">จำนวนคนกู้และผ่อน</div>
                <div class="stat-value text-neutral-content"><span class="loading loading-infinity loading-lg"></span>
                </div>
                <div class="stat-desc text-success">↘︎ Loading...</div>
            </div>

        </div>
    </center>

    <div class="container">

        <button class="btn btn-wide btn-success" onclick="my_modal_4.showModal()">เพิ่มข้อมูล</button><br><br>


        <div class="overflow-x-auto">
            <table id="example" class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>PID</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>facebook</th>
                        <th>เลขบัตร</th>
                        <th>วันที่กู้</th>
                        <th>วันที่ผ่อนรายวัน</th>
                        <th>วันที่ผ่อนรายเดือน</th>
                        <th>สถานะ</th>
                        <th>ปุ่ม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Use $pdo to execute queries and fetch data
                    $query = $conn->prepare("SELECT a.uid AS user_uid, a.fname, a.lname, a.facename, a.cardid, a.pid, a.status, b.uid,b.stna,
                    MAX(CASE WHEN c.instatus = 'pass' THEN NULL WHEN c.purchase_date = '0000-00-00' THEN NULL ELSE c.purchase_date END) AS in_dates,
    MAX(CASE WHEN c.mountstatus = 'pass' THEN NULL WHEN c.purchase_mount = '0000-00-00' THEN NULL ELSE c.purchase_mount END) AS in_mounts,
    MAX(CASE WHEN b.stna = 'pass' THEN NULL WHEN b.recovery_date = '0000-00-00' THEN NULL ELSE b.recovery_date END) AS re_dates,
    MAX(c.instatus) AS instatus,
    MAX(c.mountstatus) AS mountstatus
                    
                FROM users AS a  
                LEFT JOIN recover AS b ON a.uid = b.uid
                LEFT JOIN installment AS c ON a.uid = c.uid
                GROUP BY a.uid, a.fname, a.lname, a.facename, a.cardid, a.pid, a.status, b.uid;;");
                    if ($query->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                        echo '<tr>';
                        echo '<td><a class="btn btn-link" href="edit.php?uid=' . $row['user_uid'] . '">' . $row['pid'] . '</a></td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['lname'] . '</td>';
                        echo '<td>' . $row['facename'] . '</td>';
                        echo '<td>' . $row['cardid'] . '</td>';
                        echo '<td>' . $row['re_dates'] . '</td>';
                        echo '<td>' . $row['in_dates'] . '</td>';
                        echo '<td>' . $row['in_mounts'] . '</td>';
                        echo '<td>';
                        echo '<select name="status" class="status-dropdown" data-uid="' . $row['user_uid'] . '">';
                        echo '<option value="wait" ' . (($row['status'] == 'wait' || $row['status'] == '') ? 'selected' : '') . '>รอ</option>';
                        echo '<option value="pass" ' . ($row['status'] == 'pass' ? 'selected' : '') . '>กู้</option>';
                        echo '<option value="fail" ' . ($row['status'] == 'fail' ? 'selected' : '') . '>ผ่อน</option>';
                        echo '<option value="two" ' . ($row['status'] == 'two' ? 'selected' : '') . '>กู้+ผ่อน</option>';
                        echo '</select>';
                        echo '</td>';

                        echo '<td>';
                        echo '<div class="tooltip" data-tip="เพิ่มเติม">';
                        echo '<a href="info.php?uid=' . $row['user_uid'] . '" class="btn btn-info"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                        <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                      </svg></a>';
                        echo '</div>';
                        echo '<div class="tooltip" data-tip="ลบ">';
                        echo '<button class="btn btn-error delete-btn" data-uid="' . $row['user_uid'] . '"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg></button>';
                        echo '</div>';
                        echo '</td>';

                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

    <br><br><br><br>
    <div class="btm-nav">
        <button class="text-primary active ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </button>
        <button class="text-primary">
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
    <script>new DataTable('#example');</script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Use event delegation to handle dynamically loaded elements
            $(document).on('change', '.status-dropdown', function () {
                var uid = $(this).data('uid');
                var status = $(this).val();

                // ใช้ Ajax ส่งข้อมูลไปยังไฟล์ update_data.php
                $.ajax({
                    url: 'update_data.php',
                    method: 'POST',
                    data: { uid: uid, status: status },
                    success: function (response) {
                        // ปรับปรุง UI หรือทำอย่างอื่นตามต้องการ
                        console.log(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        // JavaScript for SweetAlert2 confirmation
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var uid = this.getAttribute('data-uid');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'ต้องการลบใช่หรือไม่!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ใช่'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete.php with uid parameter after confirmation
                            window.location.href = 'de.php?uid=' + uid;
                        }
                    });
                });
            });
        });
    </script>
    <script>
        // ดึงข้อมูลจาก get_data.php ด้วย AJAX
        fetch('get_data.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // เพิ่มบรรทัดนี้
                // กำหนดข้อมูลสำหรับกราฟ
                var pieData = {
                    labels: ['กู้', 'ผ่อน', 'กู้+ผ่อน'],
                    datasets: [{
                        data: [data.pass_u, data.fall_u, data.two_u],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50']
                    }]
                };

                // กำหนดตัวแปร context ของ canvas
                var ctx = document.getElementById('myPieChart').getContext('2d');

                // สร้างกราฟวงกลม
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: pieData
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
    <script>
        // ใช้ AJAX เพื่อดึงข้อมูลจาก get_data.php
        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // อัพเดตข้อมูลใน div ต่าง ๆ ด้วยข้อมูลที่ได้
                $('#userall .stat-value').text(data.totalUsers);
                $('#userrecover .stat-value').text(data.pass_u);
                $('#userinstall .stat-value').text(data.fall_u);
                $('#userinandre  .stat-value').text(data.two_u);

                $('#newUsersStat .stat-desc').text('↗︎ ' + data.newUsersPercent + '%');
                $('#newRegistersStat .stat-desc').text('↘︎ ' + data.newRegistersPercent + '%');
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    </script>
    <!-- <script>
        $(document).ready(function () {
            $('#leave_from_mouse').mousemove(function (e) {
                var w = $(this).width();
                var h = $(this).height();
                var ww = $(window).width() - w;
                var wh = $(window).height() - h;
                var x = Math.floor(Math.random() * 4);
                var y = {};

                switch (x) {
                    case 0:
                        y.top = ((e.clientY + wh + h) % wh) + 'px';
                        break;
                    case 1:
                        y.top = ((e.clientY + wh - h) % wh) + 'px';
                        break;
                    case 2:
                        y.left = ((e.clientX + ww + w) % ww) + 'px';
                        break;
                    case 3:
                        y.left = ((e.clientX + ww - w) % ww) + 'px';
                        break;
                }

                $(this).css(y);
            });
        });
    </script> -->
</body>


</html>