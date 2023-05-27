<?php
echo "Enter the first number: ";
$num1 = intval(trim(fgets(STDIN)));

echo "Enter the second number: ";
$num2 = intval(trim(fgets(STDIN)));

echo "Enter the operator (+, -, *, /): ";
$operator = trim(fgets(STDIN));

$result = 0;

switch ($operator) {
    case '+':
        $result = $num1 + $num2;
        break;
    case '-':
        $result = $num1 - $num2;
        break;
    case '*':
        $result = $num1 * $num2;
        break;
    case '/':
        if ($num2 != 0) {
            $result = $num1 / $num2;
        } else {
            echo "Error: Division by zero!";
            exit(1);
        }
        break;
    default:
        echo "Invalid operator!";
        exit(1);
}

echo "Result: $result\n";
?>
