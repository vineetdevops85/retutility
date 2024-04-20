<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if (isset($_POST['upload'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $excelData = [];

    // Check if a file is uploaded
    if (is_uploaded_file($file)) {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = [];
            for ($col = 1; $col <= 3; $col++) {
                $rowData[] = $sheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            $excelData[] = $rowData;
        }

        // Organize data into table format
        $tableData = [];
        foreach ($excelData as $row) {
            if ($row[1] == 'antModel') {
                $tableData[] = [$row[0], '', ''];
            } elseif ($row[1] == 'antSerial') {
                $tableData[count($tableData) - 1][1] = $row[0];
            } elseif ($row[1] == 'angle') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'antBearing') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'baseStationID') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'sectorID') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'subunitNumber') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'userNote1') {
                $tableData[count($tableData) - 1][2] = $row[0];
            } elseif ($row[1] == 'userNote2') {
                $tableData[count($tableData) - 1][2] = $row[0];
            }
        }

        // Generate Excel file for download
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"output.xls\"");
        $output = fopen("php://output", "w");
        foreach ($tableData as $row) {
            fputcsv($output, $row, "\t");
        }
        fclose($output);
        exit();
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
