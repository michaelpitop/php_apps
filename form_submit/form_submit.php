<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Validate form data (simple validation for demonstration purposes)
    if (empty($name) || empty($email)) {
        $error = "Please fill in all fields";
    } else {
        // Perform some backend logic or database operations here

        // Display success message
        $message = "Form submitted successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Application</title>
</head>
<body>
    <h1>Simple PHP Application</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

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
</body>
</html>
