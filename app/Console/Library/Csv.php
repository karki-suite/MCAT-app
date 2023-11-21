<?php

namespace App\Console\Library;

class Csv
{
    public static function readCsvToAssoc(string $file): array
    {
        $csvHandle = fopen($file, 'r');
        $csvHeaders = fgetcsv($csvHandle);
        $csvData = [];
        while(!feof($csvHandle))
        {
            $processedRow = [];
            $csvRow = fgetcsv($csvHandle);
            if(is_array($csvRow)) {
                for($i = 0; $i < count($csvRow); $i++) {
                    $processedRow[$csvHeaders[$i]] = $csvRow[$i];
                }
                $csvData[] = $processedRow;
            }
        }
        fclose($csvHandle);

        return $csvData;
    }
}
