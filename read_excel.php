<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader;

function pl($message){
    global $file_content;
    echo '<br/>'.$message;
    $file_content .= "\n" . $message; 

}

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
pl('Reader created');
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$ds = DIRECTORY_SEPARATOR;
$ds or die("Directory seperator unknown");

$inputFileName = 'test_data'.$ds.'VEDATA(1).xls';
pl("Input file $inputFileName");
$workbook = $reader->load($inputFileName);
$workbook or die("Excel file $inputFileName not loaded ");

$sheet = $workbook->getSheet(0) or die("Sheet does not contain data");



$sheetObj = $sheet;
$startFrom = 50; //default value is 1
$limit = 550; //default value is null
foreach( $sheetObj->getRowIterator($startFrom, $limit) as $row ){
    foreach( $row->getCellIterator() as $cell ){
        $value = $cell->getCalculatedValue();
        pl("Value is $value");
    }
}




// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');