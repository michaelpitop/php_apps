<?php
// Read user input from the command line
echo "Enter a number: ";
$number = trim(fgets(STDIN));

// Validate the input
if (!is_numeric($number)) {
    echo "Invalid input. Please enter a number.\n";
    exit;
}

// Perform some calculations
$square = $number * $number;
$cube = $number * $number * $number;

// Display the results
echo "Square: $square\n";
echo "Cube: $cube\n";
?>
