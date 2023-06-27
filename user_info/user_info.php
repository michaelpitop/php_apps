<?php

function createConnection()
{
    $db = new SQLite3('db.sqlite3');
    if (!$db) {
        die("Error creating database connection");
    }
    return $db;
}


function createTable($db)
{
    $query = "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT,
                age INTEGER,
                address TEXT,
                employment TEXT
            )";

    $result = $db->exec($query);
    if (!$result) {
        die("Error creating table: " . $db->lastErrorMsg());
    }
}

function insertUserData($db, $name, $age, $address, $employment)
{
    $query = "INSERT INTO users (name, age, address, employment)
                VALUES ('$name', $age, '$address', '$employment')";

    $result = $db->exec($query);
    if (!$result) {
        die("Error inserting data: " . $db->lastErrorMsg());
    }
}

function displayUserData($db)
{
    $query = "SELECT * FROM users";
    $result = $db->query($query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "ID: " . $row['id'] . PHP_EOL;
        echo "Name: " . $row['name'] . PHP_EOL;
        echo "Age: " . $row['age'] . PHP_EOL;
        echo "Address: " . $row['address'] . PHP_EOL;
        echo "Employment: " . $row['employment'] . PHP_EOL;
        echo "-------------------" . PHP_EOL;
    }
}

$db = createConnection();

createTable($db);

echo "Please enter your name: ";
$name = trim(fgets(STDIN));

echo "Please enter your age: ";
$age = intval(trim(fgets(STDIN)));

echo "Please enter your current address: ";
$address = trim(fgets(STDIN));

echo "Please enter your employment: ";
$employment = trim(fgets(STDIN));

insertUserData($db, $name, $age, $address, $employment);

displayUserData($db);

$db->close();

?>
