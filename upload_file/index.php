<?php
// File upload configuration
$uploadDir = 'uploads/'; // Directory to store uploaded files
$maxFileSize = 5 * 1024 * 1024; // Maximum file size (5MB)

// Initialize variables
$error = '';
$successMessage = '';

// Process file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    if ($file["error"] == UPLOAD_ERR_OK) {
        // Check file size
        if ($file["size"] <= $maxFileSize) {
            // Generate a unique filename
            $filename = uniqid() . '_' . $file["name"];
            $filePath = $uploadDir . $filename;

            // Move uploaded file to the desired location
            if (move_uploaded_file($file["tmp_name"], $filePath)) {
                $successMessage = 'File uploaded successfully';
            } else {
                $error = 'Failed to move uploaded file';
            }
        } else {
            $error = 'File size exceeds the maximum limit';
        }
    } else {
        $error = 'Error uploading file: ' . $file["error"];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload Application</title>
</head>
<body>
    <h1>File Upload Application</h1>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file" required><br>

        <input type="submit" value="Upload File">
    </form>

    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (!empty($successMessage)) { ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php } ?>

    <h2>Uploaded Files:</h2>
    <?php
    $files = glob($uploadDir . '*'); // Get all files in the upload directory

    if (!empty($files)) {
        echo '<ul>';
        foreach ($files as $file) {
            echo '<li>' . basename($file) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No files uploaded</p>';
    }
    ?>
</body>
</html>
