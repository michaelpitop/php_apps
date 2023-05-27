<?php
echo "Please choose a race: \n1. Human \n2. Elf \n3. Dwarf \n4. Orc \n5. Goblin\n";

$raceString = "";
$raceChoice = 0;

$validInput = false;
while (!$validInput) {
    if (intval(($raceChoice = trim(fgets(STDIN)))) && $raceChoice >= 1 && $raceChoice <= 5) {
        $validInput = true;
        switch ($raceChoice) {
            case 1:
                $raceString = "Human";
                echo "Your chosen race is $raceString\n";
                break;
            case 2:
                $raceString = "Elf";
                echo "Your chosen race is $raceString\n";
                break;
            case 3:
                $raceString = "Dwarf";
                echo "Your chosen race is $raceString\n";
                break;
            case 4:
                $raceString = "Orc";
                echo "Your chosen race is $raceString\n";
                break;
            case 5:
                $raceString = "Goblin";
                echo "Your chosen race is $raceString\n";
                break;
            default:
                $raceString = "Invalid";
                echo "Your chosen race is $raceString\n";
                break;
        }
    } else {
        echo "Invalid input, please try again.\n";
        break;
    }
}
?>
