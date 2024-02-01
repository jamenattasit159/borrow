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
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize user input
        $uid = htmlspecialchars($_POST["uid"]);

        // Check if a file is uploaded
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            // Get file information
            $file_name = basename($_FILES["file"]["name"]);
            $file_data = file_get_contents($_FILES["file"]["tmp_name"]);

            // Database connection (adjust these credentials based on your setup)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "borrow";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL statement to insert data into the database
            $stmt = $conn->prepare("INSERT INTO user_images (image_name, image_data, uid) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $file_name, $file_data, $uid);

            if ($stmt->execute()) {
                // Close statement and connection
                $stmt->close();
                $conn->close();

                // Display success message with SweetAlert2
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                    Swal.fire({
                        title: "Data inserted successfully!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = "edit.php?uid=' . $uid . '";
                    });
                  </script>';
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
    ?>

</body>

</html>