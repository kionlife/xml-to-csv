<?php

include 'core/core.php';

$input = 'http://webtest.d0.acom.cloud/test/xml-examples/example-footwearnews.xml';     //XML input
$output_path = 'res/';                                                                  //Output folder for CSV-file

$parse = new XmlToCsv;
$fields = $parse->parsing($input);
$csv = $parse->generate_csv($fields, $output_path);

if ($csv == True) {
    echo 'CSV file generated and created.';
} else {
    echo 'Error!';
}

?>
