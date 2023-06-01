<?php

// Function to encrypt a given value
function encrypt($value, $key)
{
    $iv = random_bytes(16);
    $cipherText = openssl_encrypt($value, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($iv . $cipherText);
}

// Function to decrypt an encrypted value
function decrypt($encryptedValue, $key)
{
    $encryptedValue = base64_decode($encryptedValue);
    $iv = substr($encryptedValue, 0, 16);
    $cipherText = substr($encryptedValue, 16);
    return openssl_decrypt($cipherText, 'AES-256-CBC', $key, 0, $iv);
}

// Read input from the command line
echo "Enter the value to encrypt: ";
$input = readline();

// Generate an encryption key
$key = random_bytes(32); // Change this to a secure method of generating a key

// Encrypt the input value
$encryptedValue = encrypt($input, $key);

// Save the encrypted value and key to a file
$file = fopen('encrypted_values.txt', 'a');
fwrite($file, $encryptedValue . ":" . base64_encode($key) . "\n");
fclose($file);

// Display a success message
echo "Value encrypted and saved successfully.\n";

// Read the encryption key from the command line
echo "Enter the encryption key to retrieve the value: ";
$keyInput = readline();

// Read the encrypted values and keys from the file
$lines = file('encrypted_values.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Decrypt and display the values
foreach ($lines as $line) {
    list($encrypted, $storedKey) = explode(":", $line, 2);
    $decryptedValue = decrypt($encrypted, base64_decode($storedKey));
    if ($decryptedValue !== false) {
        echo "Decrypted value: " . $decryptedValue . "\n";
    } else {
        echo "Incorrect encryption key. Unable to decrypt value.\n";
    }
}

?>
