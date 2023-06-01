<?php

// Read input from the command line
echo "Enter an equation: ";
$equation = readline();

// Sanitize the equation by removing any unwanted characters
$equation = preg_replace('/[^0-9+\-*\/\(\)\s]/', '', $equation);

// Evaluate the equation using eval() function
$result = eval("return $equation;");

// Check if eval() encountered an error
if ($result === false) {
    echo "Invalid equation!";
} else {
    echo "Result: " . $result . "\n";
}

?>
