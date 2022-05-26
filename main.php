<?php

include("vendor/autoload.php");
//use League\Csv\Writer;

use League\Csv\Reader;

$result = [];
$reader = Reader::createFromPath('file.csv', 'r');
$reader->setHeaderOffset(0);
$records = $reader->getRecords();
foreach ($records as $offset => $record) {
    $per = randPer();
    $name = $record['name'];
    $state = $record['state'];
    $result[] = [
        'title' => $name . ', ' . $state, //fields from file.csv
        'rating' => number_format(perToRating($per), 1), // adding more fields to result
        'percentage' => number_format($per, 1), // adding more fields to result
        'scholars' => mt_rand(100, 500), // adding more fields to result
    ];
}

// test the result
// print_r($result);

// write(save data to) a json file
$fp = fopen('result.json', 'w');
fwrite($fp, json_encode($result));
fclose($fp);

// utility methods
function randPer()
{
    return (mt_rand(700, 1000) * 0.1);
}

// utility methods
function perToRating(int $per)
{
    return ($per * 5 / 100);
}

//$writer = Writer::createFromPath('newfile.csv', 'w+');
//$writer->insertAll($records); //using an array

echo "file converted successfully";
