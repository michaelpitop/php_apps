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
    $questionStats = 0;
    foreach ($responses as $response) {
        if (isset($response[$questionKey - 1]) && $response[$questionKey - 1] == 1) {
            $questionStats++;
        }
    }
    $statistics[$questionKey] = $questionStats;
}

echo PHP_EOL . 'Survey Statistics:' . PHP_EOL;
foreach ($statistics as $questionKey => $questionStats) {
    $questionOptions = $options[$questionKey];
    echo $questions[$questionKey - 1] . PHP_EOL;
    $totalResponses = count($responses);
    foreach ($questionOptions as $optionKey => $optionValue) {
        $percentage = $totalResponses ? ($questionStats / $totalResponses) * 100 : 0;
        echo $optionKey . '. ' . $optionValue . ': ' . $percentage . '%' . PHP_EOL;
    }
}






?>
