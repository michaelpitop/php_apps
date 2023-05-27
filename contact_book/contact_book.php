<?php
$contacts = [];

while (true) {
    echo "\n1. Add Contact\n";
    echo "2. View Contacts\n";
    echo "3. Exit\n";

    $choice = intval(trim(fgets(STDIN)));

    switch ($choice) {
        case 1:
            echo "\nEnter contact name: ";
            $name = trim(fgets(STDIN));
            echo "Enter contact phone number: ";
            $phone = trim(fgets(STDIN));
            $contacts[] = ['name' => $name, 'phone' => $phone];
            echo "Contact added!\n";
            break;
        case 2:
            $count = count($contacts);
            echo "Number of Contacts: $count\n";
            if ($count > 0) {
                echo "Contacts:\n";
                $index = 1;
                foreach ($contacts as $contact) {
                    echo "$index. Name: " . $contact['name'] . ", Phone: " . $contact['phone'] . "\n";
                    $index++;
                }
            } else {
                echo "No contacts found!\n";
            }
            break;
        case 3:
            exit(0);
        default:
            echo "Invalid choice!\n";
            break;
    }
}
?>
