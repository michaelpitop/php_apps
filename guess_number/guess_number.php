<?php
$secretNumber = rand(1, 10);
$attempts = 0;

echo "Welcome to the Guess the Number Game!\n";
echo "I'm thinking of a number between 1 and 10. Can you guess it?\n";

while (true) {
    echo "Enter your guess: ";
    $guess = intval(trim(fgets(STDIN)));
    $attempts++;

    if ($guess === $secretNumber) {
        echo "Congratulations! You guessed the number in $attempts attempts!\n";
        break;
    } elseif ($guess < $secretNumber) {
        echo "Too low! Try again.\n";
    } else {
        echo "Too high! Try again.\n";
    }
}
?>
