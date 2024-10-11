<?php

// Source folder
$sourceFolder = '/home/sftpgo/data/data/Wattmon';

// Destination folder
$destinationFolder = '/home/thiru/fileflow/csv';

// Temporary folder
$tempFolder = '/home/thiru/csv-to-influx-wattmon-vilva-fruits/csv-source';

// Create date-wise folder
$dateFolder = date('Y-m-d');
$dateFolderPath = $destinationFolder . '/' . $dateFolder;

if (!file_exists($dateFolderPath)) {
    mkdir($dateFolderPath, 0777, true);
}

// Function to extract pattern from filename
function extractPattern($filename) {
    // Assuming the pattern is the part before the first underscore
    $pattern = strtok($filename, '_');
    return $pattern;
}

// Function to move files recursively
function moveFiles($sourceFolder, $destinationFolder, $tempFolder) {
    $files = glob($sourceFolder . '/*');

    foreach ($files as $file) {
        if (is_dir($file)) {
            // Recursively move files inside subfolders
            moveFiles($file, $destinationFolder, $tempFolder);
        } else {
            // Move file to destination folder
            $filename = basename($file);
            $pattern = extractPattern($filename);
            $patternFolderPath = $destinationFolder . '/' . $pattern;

            if (!file_exists($patternFolderPath)) {
                mkdir($patternFolderPath, 0777, true);
            }

            $newFilePath = $patternFolderPath . '/' . $filename;
            rename($file, $newFilePath);

            if($pattern == "9C956E78E3E0" || $pattern == "9C956E78E40D" || $pattern == "9C956E78E379"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-best-green/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);                
            }elseif($pattern == "D8478F42B1FB"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);                
            }elseif($pattern == "D8458F42BB20"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42BA80" || $pattern == "D8478F42BB82"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-aalayam-wind-farm/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E5327B0"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-vilva-fruits/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42BB20"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E532793"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-sol-swift-solutions/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42B223"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-prosun/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "608A108DC956"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-tiger-power/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42B6F0"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-indway/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }

        }
    }
}

// Move files recursively from source to destination folder
moveFiles($sourceFolder, $dateFolderPath, $tempFolder);

echo "Files moved successfully.";

?>

