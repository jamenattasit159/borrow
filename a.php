<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Add the SweetAlert2 CDN links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
<img src="https://scontent.fbkk29-6.fna.fbcdn.net/v/t1.15752-9/420078162_850418813436220_160355886098785098_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeFFJ6_69bP7pWqU1gqw_sWx7ZsKCSD662PtmwoJIPrrY_opNBkFnpDXM9Q721mXUnpZkCosacJkDsTdg_4AWh57&_nc_ohc=tNrmJ_xFxLsAX_8hT2U&_nc_ht=scontent.fbkk29-6.fna&oh=03_AdRx8z4G-1Y8TrqrT0FkoqrfTomPD-eOK4TIe19ViuHQzA&oe=65E209AC" alt="Girl in a jacket" width="200" height="auto">
    <?php
    // Check if the form is submitted
    

    // Database connection (adjust these credentials based on your setup)
    $servername = "localhost";
    $username = "id21830595_jamenattasit";
    $password = "Nattasit15995100!";
    $dbname = "id21830595_borrow";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];

    $uid = $_POST['uid'];

    // Insert data into the database
    $sql = "INSERT INTO address_records (address_line1,address_line2, city,province,postal_code,uid) VALUES ('$address_line1','$address_line2', '$city', '$province', '$postal_code', '$uid')";

    if ($conn->query($sql) === TRUE) {
        // Close the database connection
        $conn->close();

        // Display SweetAlert2 success message with dynamic UID
        echo "<script>
            var uid = " . json_encode($uid) . ";
            Swal.fire({
                icon: 'success',
                title: 'บันทึกที่อยู่เสร็จแล้วฮ่าฟฟฟฟฟ!',
                showConfirmButton: false,
                timer: 1500
            }).then(function () {
                window.location.href = 'info.php?uid=' + uid;
            });
          </script>";
    } else {
        // Display SweetAlert2 error message
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Data insertion failed. Please try again.',
            });
          </script>";
    }

    ?>

</body>

</html>