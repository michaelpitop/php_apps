<?php

$questions = [
    'Q1. What is your favorite color?',
    'Q2. What is your favorite animal?',
    'Q3. What is your favorite food?',
];

$options = [
    'Q1' => ['A' => 'Red', 'B' => 'Blue', 'C' => 'Green'],
    'Q2' => ['A' => 'Dog', 'B' => 'Cat', 'C' => 'Bird'],
    'Q3' => ['A' => 'Pizza', 'B' => 'Burger', 'C' => 'Sushi'],
];

$responses = [];


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

    $response = '';
    while (!array_key_exists($response, $questionOptions)) {
        echo 'Your choice: ';
        $response = trim(fgets(STDIN));
    }
    $responses[] = $questionOptions[$response];
}


$statistics = [];
foreach ($options as $questionKey => $questionOptions) {
    $questionStats = array_count_values($responses)[$questionOptions['A']] ?? 0;
    $statistics[$questionKey] = $questionStats;
}


echo PHP_EOL . 'Survey Statistics:' . PHP_EOL;
foreach ($statistics as $questionKey => $questionStats) {
    $questionOptions = $options[$questionKey];
    echo $questionKey . ' - ' . PHP_EOL;
    foreach ($questionOptions as $optionKey => $optionValue) {
        $percentage = $questionStats ? ($questionStats / count($responses)) * 100 : 0;
        echo $optionKey . '. ' . $optionValue . ': ' . $percentage . '%' . PHP_EOL;
    }
}
?>
