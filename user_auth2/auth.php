<?php
// User registration
function registerUser($username, $password)
{
    $users = getUsers();

    // Check if the username is already taken
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return false;
        }
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Add the user to the users array
    $users[] = [
        'username' => $username,
        'password' => $hashedPassword
    ];

    // Save the updated users array to file
    saveUsers($users);

    return true;
}

// User authentication
function authenticateUser($username, $password)
{
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

// Get users from file
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

// Save users to file
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
    echo "Welcome back, $username!";
    echo PHP_EOL;
    echo "To logout, type 'logout'";
    echo PHP_EOL;
    exit();
}

// Process user actions
if (isset($argv[1])) {
    $command = $argv[1];

    if ($command === 'register') {
        if (isset($argv[2]) && isset($argv[3])) {
            $username = $argv[2];
            $password = $argv[3];

            if (registerUser($username, $password)) {
                echo "Registration successful! You can now login with your credentials.";
                echo PHP_EOL;
            } else {
                echo "Username is already taken. Please choose a different username.";
                echo PHP_EOL;
            }
        } else {
            echo "Please provide a username and password for registration.";
            echo PHP_EOL;
        }
    } elseif ($command === 'login') {
        if (isset($argv[2]) && isset($argv[3])) {
            $username = $argv[2];
            $password = $argv[3];

            if (authenticateUser($username, $password)) {
                $_SESSION['username'] = $username;
                echo "Login successful! Welcome, $username!";
                echo PHP_EOL;
                echo "To logout, type 'logout'";
                echo PHP_EOL;
            } else {
                echo "Invalid username or password. Please try again.";
                echo PHP_EOL;
            }
        } else {
            echo "Please provide a username and password for login.";
            echo PHP_EOL;
        }
    } elseif ($command === 'logout') {
        echo "You are not currently logged in.";
        echo PHP_EOL;
    } else {
        echo "Invalid command.";
        echo PHP_EOL;
        echo "Usage:";
        echo PHP_EOL;
        echo "To register: php auth.php register <username> <password>";
        echo PHP_EOL;
        echo "To login: php auth.php login <username> <password>";
        echo PHP_EOL;
    }
} else {
    echo "Invalid command.";
    echo PHP_EOL;
    echo "Usage:";
    echo PHP_EOL;
    echo "To register: php auth.php register <username> <password>";
    echo PHP_EOL;
    echo "To login: php auth.php login <username> <password>";
    echo PHP_EOL;
}
?>
    