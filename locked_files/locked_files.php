<?php

// Function to download a file
function downloadFile($key)
{
    // Check if the provided key is correct
    if ($key === '1234') { 
        $fileUrl = '/home/michaelpitop/code/michaelpitop/php_apps/locked_files/Michael Pitopoulakis Lebenslauf.pdf'; 
        $outputFile = 'Michael Pitopoulakis Lebenslauf.pdf'; 

        // Download the file
        $command = "wget -O {$outputFile} {$fileUrl}";
        system($command);

        echo "File downloaded successfully.\n";
    } else {
        echo "Incorrect key. Unable to download the file.\n";
    }
}

// Read the encryption key from the command line
echo "Enter the key to download the file: ";
$keyInput = readline();

// Call the downloadFile function with the provided key
downloadFile($keyInput);

?>
