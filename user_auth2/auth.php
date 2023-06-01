<?php
// Function to register a new user
function registerUser($username, $password)
{
    // Check if the username already exists
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return false;
        }
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Save the new user to the users array
    $users[] = [
        'username' => $username,
        'password' => $hashedPassword
    ];

    // Save the updated users array to the file
    saveUsers($users);

    return true;
}

// Function to authenticate a user
function authenticateUser($username, $password)
{
    // Retrieve the list of registered users
    $users = getUsers();

    // Find the user by username
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
    }

    return false;
}

// Function to retrieve the list of registered users
function getUsers()
{
    $usersFile = 'users.txt';

    if (!file_exists($usersFile)) {
        return [];
    }

    // Read the contents of the file
    $contents = file_get_contents($usersFile);

    // Decode the contents into an associative array
    $users = unserialize($contents);

    // Return the users array
    return $users ?: [];
}

// Function to save the list of registered users to file
function saveUsers($users)
{
    $usersFile = 'users.txt';

    // Serialize the users array
    $contents = serialize($users);

    // Save the serialized contents to the file
    file_put_contents($usersFile, $contents);
}

// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "You are already logged in as $username.";
    echo PHP_EOL;
    echo "To logout, press 1.";
    echo PHP_EOL;
} else {
    // Process user commands
    if (isset($argv[1])) {
        $command = $argv[1];

        if ($command === 'register') {
            if (isset($argv[2]) && isset($argv[3])) {
                $username = $argv[2];
                $password = $argv[3];

                if (registerUser($username, $password)) {
                    echo "Registration successful! You can now login with your credentials.";
                } else {
                    echo "Username already exists. Please choose a different username.";
                }
            } else {
                echo "Please provide a username and password for registration.";
            }
        } elseif ($command === 'login') {
            if (isset($argv[2]) && isset($argv[3])) {
                $username = $argv[2];
                $password = $argv[3];

                if (authenticateUser($username, $password)) {
                    $_SESSION['username'] = $username;
                    echo "Login successful! Welcome, $username!";
                    echo PHP_EOL;
                } else {
                    echo "Invalid username or password. Please try again.";
                }
            } else {
                echo "Please provide a username and password for login.";
            }
        } else {
            echo "Invalid command.";
        }
    } else {
        echo "Please provide a command.";
    }
}

// Handle logout option
if (isset($_SESSION['username']) && isset($argv[1]) && $argv[1] === '1') {
    session_destroy();
    echo "You have been logged out.";
}

echo PHP_EOL;
echo "Press any key to exit...";
fgets(STDIN);
