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


    <style>
        tr {
            color: white;
            box-shadow: 2px 2px 5px purple;
            /* เงาสีม่วง */
            font-weight: bold;
            /* ตัวหนา */
        }

        td {
            color: white;
            box-shadow: 2px 2px 5px purple;
            /* เงาสีม่วง */
            font-weight: bold;
            /* ตัวหนา */
        }

        th {
            color: white;
            text-shadow: 2px 2px 5px purple;
            /* เงาสีม่วง */
            font-weight: bold;
            /* ตัวหนา */
        }

        .image-container {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            /* ไม่ให้ Flex items ขึ้นบรรทัดใหม่ */
            overflow-x: auto;
            /* เพิ่ม scrollbar ในกรณีที่รูปมีมากเกินไป */
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
        }

        .zoom-buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            text-align: center;
        }

        .zoom-buttons button {
            margin: 5px;
            padding: 5px;
            cursor: pointer;
        }

        .zoomable-image {
            max-width: 300px;
            height: auto;
            transition: transform 0.3s ease-out;
        }

        .zoomable-image:hover {
            transform: scale(1.2);
        }
    </style>

    <title>Document</title>
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
            <a class="btn btn-ghost text-xl">ข้อมูลส่วนตัว</a>
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
    <dialog id="my_modal_img" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Hello!</h3>

            <form class="card-body" method="post" enctype="multipart/form-data" action="insert_image.php ">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">เลือกรูปบัตรปปช.</span>
                    </label>
                    <input type="file" name="file"
                        class="file-input file-input-bordered file-input-secondary w-full max-w-xs" />
                </div>
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                <div class="form-control mt-6">
                    <button class="btn btn-primary">บันทึก</button>

                </div>
            </form>
        </div>
        </div>
    </dialog>
    <div class="container1">
        <center>
            <h1>รายละเอียด</h1>
            <button class="btn btn-wide btn-success" onclick="my_modal_4.showModal()">แก้ไขข้อมูลส่วนตัว<svg
                    class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 18">
                    <path
                        d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm-1.391 7.361.707-3.535a3 3 0 0 1 .82-1.533L7.929 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h4.259a2.975 2.975 0 0 1-.15-1.639ZM8.05 17.95a1 1 0 0 1-.981-1.2l.708-3.536a1 1 0 0 1 .274-.511l6.363-6.364a3.007 3.007 0 0 1 4.243 0 3.007 3.007 0 0 1 0 4.243l-6.365 6.363a1 1 0 0 1-.511.274l-3.536.708a1.07 1.07 0 0 1-.195.023Z" />
                </svg></button>
            <button class="btn btn-wide btn-success" onclick="my_modal_img.showModal()">
                เพิ่มรูปภาพ
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 18">
                    <path
                        d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm-1.391 7.361.707-3.535a3 3 0 0 1 .82-1.533L7.929 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h4.259a2.975 2.975 0 0 1-.15-1.639ZM8.05 17.95a1 1 0 0 1-.981-1.2l.708-3.536a1 1 0 0 1 .274-.511l6.363-6.364a3.007 3.007 0 0 1 4.243 0 3.007 3.007 0 0 1 0 4.243l-6.365 6.363a1 1 0 0 1-.511.274l-3.536.708a1.07 1.07 0 0 1-.195.023Z" />
                </svg>
            </button><br><br>
        </center>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>รหัสประจำตัว</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>Facebook</th>
                        <th>เลขบัตร</th>

                    </tr>
                </thead>
                <tbody id="userDataBody">
                    <?php
                    require_once 'connect.php';
                    // ตรวจสอบว่ามีการระบุ uid ใน URL หรือไม่
                    //     if (isset($_GET['uid'])) {
                    //         $uid = $_GET['uid'];
                    //     }
                    //     // Use $pdo to execute queries and fetch data
                    //     $query = $conn->prepare("SELECT 
                    //    *
                    // FROM users AS a
                    
                    // WHERE a.uid = $uid;
                    // ");
                    
                    if ($stmt->execute() === false) {
                        die('Error executing the query');
                    }

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['pid'] . '</td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['lname'] . '</td>';
                        echo '<td>' . $row['facename'] . '</td>';
                        echo '<td>' . $row['cardid'] . '</td>';

                        echo '</tr>';
                    }
                    ?>
                </tbody>

            </table>
        </div>
        <?php
        require_once 'connect.php';
        // ตรวจสอบว่ามีการระบุ uid ใน URL หรือไม่
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];

            // ตรวจสอบว่ามีการส่งค่า POST มาหรือไม่
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // รับค่าที่ส่งมาจากฟอร์ม
                $uid = $_POST['uid'];
                $newFname = $_POST['fname'];
                $newLname = $_POST['lname'];
                $newface = $_POST['facename'];
                $newcard = $_POST['cardid'];
                $newpid = $_POST['pid'];
                // เพิ่มฟิลด์อื่น ๆ ตามต้องการ
        
                // ทำการอัปเดตข้อมูล
                $query = "UPDATE users SET fname = :fname, lname = :lname, facename = :facename, cardid = :cardid, pid = :pid WHERE uid = :uid";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':fname', $newFname, PDO::PARAM_STR);
                $stmt->bindParam(':lname', $newLname, PDO::PARAM_STR);
                $stmt->bindParam(':facename', $newface, PDO::PARAM_STR);
                $stmt->bindParam(':cardid', $newcard, PDO::PARAM_STR);
                $stmt->bindParam(':pid', $newpid, PDO::PARAM_STR);
                $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

                // ทำการ execute คำสั่ง SQL
                if ($stmt->execute()) {
                    echo "<script>
            var uid = " . json_encode($uid) . ";
            Swal.fire({
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ!',
                showConfirmButton: false,
                timer: 1500
            }).then(function () {
                window.location.href = 'edit.php?uid=' + uid;
            });
          </script>";
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
                }
            }

            // ทำการ query เพื่อดึงข้อมูลลูกค้าที่ต้องการแก้ไข
            $query = $conn->prepare("SELECT * FROM users WHERE uid = :uid");
            $query->bindParam(':uid', $uid, PDO::PARAM_INT);
            $query->execute();

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if ($query->rowCount() > 0) {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                // แสดงข้อมูลลูกค้าในแบบฟอร์ม
        
                echo '<dialog id="my_modal_4" class="modal">';
                echo '  <div class="modal-box w-11/12 max-w-xl">';
                echo ' <form method="dialog">';
                echo '  <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>';
                echo '   </form>';
                echo '    <h3 class="font-bold text-lg">แก้ไขข้อมูล</h3>';

                echo '    <form class="card-body" action="" method="post">';
                echo '      <input type="hidden" name="uid" value="' . $row['uid'] . '">';

                echo '      <div class="form-control">';
                echo '        <label class="label">';
                echo '          <span class="label-text">PID</span>';
                echo '        </label>';
                echo '        <input type="text" name="pid" class="input input-bordered input-warning w-full max-w-xs" value="' . $row['pid'] . '"><br>';
                echo '      </div>';

                echo '      <div class="form-control">';
                echo '        <label class="label">';
                echo '          <span class="label-text">ชื่อ</span>';
                echo '        </label>';
                echo '        <input type="text" name="fname" class="input input-bordered input-warning w-full max-w-xs" value="' . $row['fname'] . '"><br>';
                echo '      </div>';

                echo '      <div class="form-control">';
                echo '        <label class="label">';
                echo '          <span class="label-text">นามสกุล</span>';
                echo '        </label>';
                echo '        <input type="text" name="lname" class="input input-bordered input-warning w-full max-w-xs" value="' . $row['lname'] . '"><br>';
                echo '      </div>';

                echo '      <div class="form-control">';
                echo '        <label class="label">';
                echo '          <span class="label-text">ชื่อ Facebook</span>';
                echo '        </label>';
                echo '        <input type="text" name="facename" class="input input-bordered input-warning w-full max-w-xs" value="' . $row['facename'] . '"><br>';
                echo '      </div>';

                echo '      <div class="form-control">';
                echo '        <label class="label">';
                echo '          <span class="label-text">เลขบัตร</span>';
                echo '        </label>';
                echo '        <input type="text" name="cardid" class="input input-bordered input-warning w-full max-w-xs" value="' . $row['cardid'] . '"><br>';
                echo '      </div>';

                echo '      <div class="form-control mt-6">';
                echo '        <button class="btn btn-success" type="submit" value="บันทึก">บันทึก</button>';
                echo '      </div>';
                echo '    </form>';
                echo '  </div>';
                echo '</dialog>';

            } else {
                echo "ไม่พบข้อมูลลูกค้า";
            }
        } else {
            echo "ไม่ได้ระบุ ID ของลูกค้า";
        }
        ?>
        <br>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "borrow";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT  * FROM user_images where uid = $uid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $img_id = $row["image_id"];
                $image_name = $row["image_name"];
                $image_data = base64_encode($row["image_data"]);
                echo "<div class='image-container'>";
                echo "<a href='data:image/jpeg;base64,{$image_data}' data-fancybox='images' data-caption='{$image_name}'>";
                echo "<img class='zoomable-image' id='zoomableImage{$img_id}' src='data:image/jpeg;base64,{$image_data}' alt='{$image_name}' />";
                echo "</a>";
                echo "<div class='zoom-buttons'>";
                echo "<button class='zoom-in' onclick=\"zoomImage('zoomableImage{$img_id}', true)\">Zoom In</button>";
                echo "<button class='zoom-out' onclick=\"zoomImage('zoomableImage{$img_id}', false)\">Zoom Out</button>";
                echo "<form method='post' action='delete_image.php'>";
                echo "<input type='hidden' name='img_id' value='{$img_id}' />";
                echo "<input type='hidden' name='uid' value='{$uid}' />";
                echo "<button class='btn btn-square btn-outline' type='submit'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>";
                echo "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />";
                echo "</svg>";
                echo "</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }

        $conn->close();
        ?>
    </div>
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImg" class="modal-content">
    </div>
    <br>
    </div>
    <br>
    </div>
    <br><br>
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
        <label class="swap swap-rotate">

            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" class="theme-controller" value="synthwave" />

            <!-- sun icon -->
            <svg class="swap-on fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
            </svg>

            <!-- moon icon -->
            <svg class="swap-off fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
            </svg>

        </label>
    </div>
    <script>
        function zoomImage(imageId, zoomIn) {
            var image = document.getElementById(imageId);
            var zoomLevel = parseFloat(image.style.transform.replace('scale(', '').replace(')', '')) || 1;

            if (zoomIn) {
                zoomLevel += 0.1;
            } else {
                zoomLevel -= 0.1;
            }

            zoomLevel = Math.max(0.1, zoomLevel);
            image.style.transform = 'scale(' + zoomLevel + ')';
        }
    </script>
</body>

</html>