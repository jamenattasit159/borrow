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

    if (isset($_GET['uid'])) {
        // Sanitize the input to prevent SQL injection
        $uid = filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Start a database transaction
            $conn->beginTransaction();

            // Step 1: Delete from the child table 'recover'
            $deleteRecoverQuery = $conn->prepare("DELETE FROM recover WHERE uid = :uid");
            $deleteRecoverQuery->bindParam(":uid", $uid, PDO::PARAM_INT);

            if (!$deleteRecoverQuery->execute()) {
                // Rollback the transaction and exit if an error occurs
                $conn->rollBack();
                echo "Error deleting data from recover";
                exit();
            }

            // Step 2: Delete from the child table 'address_records'
            $deleteAddressQuery = $conn->prepare("DELETE FROM address_records WHERE uid = :uid");
            $deleteAddressQuery->bindParam(":uid", $uid, PDO::PARAM_INT);

            if (!$deleteAddressQuery->execute()) {
                // Rollback the transaction and exit if an error occurs
                $conn->rollBack();
                echo "Error deleting data from address_records";
                exit();
            }
            // Step 3: Delete from the parent table 'installment'
            $deleteinstallmentQuery = $conn->prepare("DELETE FROM installment WHERE uid = :uid");
            $deleteinstallmentQuery->bindParam(":uid", $uid, PDO::PARAM_INT);

            if (!$deleteinstallmentQuery->execute()) {
                // Rollback the transaction and exit if an error occurs
                $conn->rollBack();
                echo "Error deleting data from installment";
                exit();
            }
            // If all queries executed successfully, commit the transaction
            $conn->commit();

            $deleteimage = $conn->prepare("DELETE FROM user_images WHERE uid = :uid");
            $deleteimage->bindParam(":uid", $uid, PDO::PARAM_INT);

            if (!$deleteimage->execute()) {
                // Rollback the transaction and exit if an error occurs
                $conn->rollBack();
                echo "Error deleting data from user_images";
                exit();
            }
            // Step 6: Delete from the parent table 'users'
            $deleteUserQuery = $conn->prepare("DELETE FROM users WHERE uid = :uid");
            $deleteUserQuery->bindParam(":uid", $uid, PDO::PARAM_INT);

            if (!$deleteUserQuery->execute()) {
                // Rollback the transaction and exit if an error occurs
                $conn->rollBack();
                echo "Error deleting data from users";
                exit();
            }
            // Display SweetAlert2 confirmation and redirect
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data deleted successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    // Redirect to info.php after the SweetAlert2 message
                    window.location.href = 'index.php';
                });
            </script>";
            exit(); // Ensure that no additional content is output after the redirect
        } catch (Exception $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Redirect to index.php if uid parameter is not set
        ob_end_clean();  // Clear output buffer
        header("Location: index");
        exit();  // Make sure to exit after sending the header
    }

    // Close the database connection
    unset($conn);
    ?>
</body>

</html>