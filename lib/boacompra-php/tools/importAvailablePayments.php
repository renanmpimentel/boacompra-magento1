<?php

function parseCSV($data)
{
    $file_handle = fopen($data, 'r');
    $lines = [];
    while (!feof($file_handle)) {
        $data = fgetcsv($file_handle, 1024, ';');
        $lines[$data[0]] = $data;
    }
    fclose($file_handle);
    $lines = array_map(function ($data) {
        return array(
            'PaymentId'          => $data[0],
            'PaymentName'        => $data[1],
            'CountriesAvailable' => countries($data[2]),
            'PaymentType'        => $data[3],
            'PaymentGroup'       => $data[4],
        );
    }, $lines);
    unset($lines[0]);

    return $lines;
}

function countries($data)
{
    if (strpos($data, ',') !== false) {
        $data = explode(',', $data);
    }

    return $data;
}

$csvFile = '../data/temp/availablePayments.csv';
$csv = parseCSV('../temp/availablePayments.csv');

$handle = fopen('../data/availablePayments.json', 'w');
$data = json_encode($csv);
fwrite($handle, $data);

