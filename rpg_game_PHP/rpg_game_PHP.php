<?php
class RPGGame {
    public static function Main() {
        // Player character
        $playerName = "";
        $playerHealth = 100;
        $playerAttack = 10;
        $playerDefense = 5;

        echo "Welcome to the RPG Game\n";
        echo "Enter your name: ";
        $playerName = trim(fgets(STDIN));
        echo "Welcome $playerName\n";

        echo "\nHere are your stats:\n";
        echo "Name: $playerName\n";
        echo "Health: $playerHealth\n";
        echo "Attack: $playerAttack\n";
        echo "Defense: $playerDefense\n";

        // Enemy Character
        $enemyName = "Zombie";
        $enemyHealth = 50;
        $enemyAttack = 5;
        $enemyDefense = 2;

        echo "\nYou encounter a $enemyName with $enemyHealth health.\n";

        // Battle loop
        while ($playerHealth > 0 && $enemyHealth > 0) {
            echo "\nWhat do you want to do?\n";
            echo "1. Attack\n";
            echo "2. Defend\n";

            $choice = intval(trim(fgets(STDIN)));

            // if player attacks
            if ($choice == 1) {
                echo "\nYou attack the $enemyName for $playerAttack damage.\n";
                $enemyHealth -= $playerAttack - $enemyDefense;
            } elseif ($choice == 2) {
                echo "You brace for the enemy's attack.\n";
                $playerHealth -= $enemyAttack - $playerDefense / 2;
            } else {
                echo "Invalid choice, please try again!\n";
                continue;
            }

            // enemy attacks
            echo "The $enemyName attacks you for $enemyAttack damage!\n";
            $playerHealth -= $enemyAttack - $playerDefense;
            $playerDefense = 5;

            // display Health
            echo "\nYour health: $playerHealth\n";
            echo "Enemy's health: $enemyHealth\n";
        }

        // who wins
        if ($playerHealth <= 0) {
            echo "\nYou Lost! :c\n";
        } else {
            echo "You defeated the $enemyName!\n";
        }

        readline();
    }
}

RPGGame::Main();
?>
