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
    // Include your database connection code here
    // For example: include 'db_connect.php';
    require_once 'connect.php';

    if (isset($_GET['recid'], $_GET['user_uid'])) {
        // Sanitize the input to prevent SQL injection
        $recid = filter_var($_GET['recid'], FILTER_SANITIZE_NUMBER_INT);
        $userUid = filter_var($_GET['user_uid'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Use prepared statement to delete data from the recover table
            $query = $conn->prepare("DELETE FROM recover WHERE recid = :recid");
            $query->bindParam(":recid", $recid, PDO::PARAM_INT);

            // Execute the query
            if ($query->execute()) {
                // Data deleted successfully
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "ลบสำเร็จแล้วน้าาา!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        var userUid = ' . json_encode($userUid) . ';
                        window.location.href = "info.php?uid=" + userUid;
                    });
                </script>';
            } else {
                // Error executing the query
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error Deleting Data",
                        text: "An error occurred while deleting data."
                    }).then(function () {
                        var userUid = ' . json_encode($userUid) . ';
                        window.location.href = "info.php?uid=" + userUid;
                    });
                </script>';
            }
        } catch (Exception $e) {
            // Handle exceptions
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred: ' . $e->getMessage() . '"
                }).then(function () {
                    var userUid = ' . json_encode($userUid) . ';
                    window.location.href = "info.php?uid=" + userUid;
                });
            </script>';
        }
    } else {
        echo '<script>
            setTimeout(function() {
                var userUid = ' . json_encode($_GET['user_uid']) . ';
                window.location.href = "info.php?uid=" + userUid;
            }, 2000); 
        </script>';
    }

    // Close the database connection
    unset($conn);
    ?>
</body>

</html>