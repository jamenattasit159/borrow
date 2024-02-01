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
$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$facename = isset($_POST['facename']) ? $_POST['facename'] : '';
$cardid = isset($_POST['cardid']) ? $_POST['cardid'] : '';

// Check if 'pid' is not empty before proceeding
if (empty($pid)) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'PID cannot be empty. Please provide a valid PID.',
            });
          </script>";
    exit; // Stop execution if 'pid' is empty
}

// Insert data into the database using prepared statements
$stmt = $conn->prepare("INSERT INTO users (pid, fname, lname, facename, cardid) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $pid, $fname, $lname, $facename, $cardid);

if ($stmt->execute()) {
    // Close the database connection
    $stmt->close();
    $conn->close();

    // Display SweetAlert2 success message
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกเสร็จแล้วน้าาาาาา!',
                showConfirmButton: false,
                timer: 1500
            }).then(function () {
                // Redirect to index.php after the SweetAlert2 message
                window.location.href = 'index.php';
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