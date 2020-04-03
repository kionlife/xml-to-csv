<?php

include 'core/core.php';

$input = 'res/data.xml';     //вхідний XML файл
$output_path = 'res/';    //вихідний CSV файл

$parse = new XmlToCsv;
$fields = $parse->parsing($input);
$csv = $parse->generate_csv($fields, $output_path);

if ($csv == True) {
    echo 'CSV file generated and created.';
} else {
    echo 'Error!';
}

?>
