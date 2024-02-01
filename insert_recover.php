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
    <?php
    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "borrow";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Get data from the form
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $recovery_date = $_POST['recovery_date'];
    $uid = $_POST['uid'];

    // Insert data into the database
    $sql = "INSERT INTO recover (loan_amount,interest_rate, recovery_date,uid) VALUES ('$loan_amount','$interest_rate', '$recovery_date', '$uid')";

    if ($conn->query($sql) === TRUE) {
        // Close the database connection
        $conn->close();

        // Display SweetAlert2 success message
        echo "<script>
            var uid = " . json_encode($uid) . ";
            Swal.fire({
                icon: 'success',
                title: 'บันทึกยอดกู้ให้เรี้ยวววว!',
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