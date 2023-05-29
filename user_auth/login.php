<?php
// User credentials
$storedUsername = 'admin';
$storedPassword = 'password';

// Authentication function
function authenticateUser($username, $password)
{
    global $storedUsername, $storedPassword;
    if ($username === $storedUsername && $password === $storedPassword) {
        return true;
    }
    return false;
}

// Login process
function login()
{
    echo "Please enter your credentials.\n";
    $username = readline("Username: ");
    $password = readline("Password: ");

    if (authenticateUser($username, $password)) {
        echo "\nLogin successful!\n";
        // Continue with your application logic here
    } else {
        echo "\nWARNING: Invalid username or password. Please try again.\n";
    }
}

// Logout process
function logout()
{
    echo "\nLogged out successfully.\n";
    // Perform any necessary cleanup or additional tasks upon logout
    exit(); // Terminate the script after logout
}

// Main program loop
while (true) {
    echo "\nWelcome to the User Authenticator App!\n";
    echo "Please choose an action:\n";
    echo "\n1. Login\n";
    echo "2. Quit\n";

    $choice = intval(trim(fgets(STDIN)));

    switch ($choice) {
        case 1:
            login();
            break;
        case 2:
            logout();
            break;
        default:
            echo "Invalid choice. Please try again.\n";
    }
}
?>
