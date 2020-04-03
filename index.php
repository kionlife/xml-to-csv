<?php

include 'core/core.php';

$input = 'res/data.xml';     //вхідний XML файл
$output = 'res/data.csv';    //вихідний CSV файл

$parse = new XmlToCsv;
$fields = $parse->parsing($input);
$csv = $parse->generate_csv($fields, $output);

if ($csv == True) {
    echo 'CSV file generated and created.';
} else {
    echo 'Error!';
}

?>
