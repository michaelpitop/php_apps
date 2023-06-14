<?php
$questions = [
    'Q1. What is your favorite color?',
    'Q2. What is your favorite animal?',
    'Q3. What is your favorite food?',
];

$options = [
    'Q1' => ['1' => 'Red', '2' => 'Blue', '3' => 'Green'],
    'Q2' => ['1' => 'Dog', '2' => 'Cat', '3' => 'Bird'],
    'Q3' => ['1' => 'Pizza', '2' => 'Burger', '3' => 'Sushi'],
];

$responses = [];

while (true) {
    foreach ($questions as $key => $question) {
        echo $question . PHP_EOL;
        $questionKey = 'Q' . ($key + 1);
        $questionOptions = $options[$questionKey] ?? null;
        if (!$questionOptions) {
            echo "Options for question $questionKey not found." . PHP_EOL;
            continue;
        }
        foreach ($questionOptions as $optionKey => $optionValue) {
            echo $optionKey . '. ' . $optionValue . PHP_EOL;
        }

        echo 'Enter your choice (or enter "quit" to exit): ';
        $response = trim(fgets(STDIN));
        if ($response === 'quit') {
            break 2; // Break out of both loops and exit the survey
        }

        if (!array_key_exists($response, $questionOptions)) {
            echo 'Invalid choice. Please try again.' . PHP_EOL;
            continue;
        }

        $responses[] = [$questionKey => $response];
    }
}

$statistics = [];
foreach ($options as $questionKey => $questionOptions) {
    $questionStats = array_count_values(array_column($responses, $questionKey));
    $statistics[$questionKey] = $questionStats;
}

echo PHP_EOL . 'Survey Statistics:' . PHP_EOL;
foreach ($statistics as $questionKey => $questionStats) {
    echo $questions[(int)substr($questionKey, 1) - 1] . PHP_EOL;
    foreach ($questionStats as $optionKey => $count) {
        echo $optionKey . '. ' . $options[$questionKey][$optionKey] . ': ' . $count . PHP_EOL;
    }
}
?>
