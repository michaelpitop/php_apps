<?php
// Start or resume the session
session_start();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Validate form data (simple validation for demonstration purposes)
    if (empty($name) || empty($email)) {
        $error = "Please fill in all fields";
    } else {
        // Store the submitted data in session variables
        $_SESSION['users'][] = array('name' => $name, 'email' => $email);

        // Display success message
        $message = "Form submitted successfully";
    }
}

// Retrieve stored data from session
$storedData = isset($_SESSION['users']) ? $_SESSION['users'] : array();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Form and Showcase Data</title>
</head>
<body>
    <h1>Submit Form and Showcase Data</h1>

    <?php if (isset($message)) { ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <input type="submit" value="Submit">
    </form>

    <h2>Stored Data:</h2>
    <?php if (!empty($storedData)) { ?>
        <ul>
            <?php foreach ($storedData as $userData) { ?>
                <li><?php echo $userData['name'] . ' - ' . $userData['email']; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No data available</p>
    <?php } ?>
</body>
</html>
