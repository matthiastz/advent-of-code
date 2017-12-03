<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 03.12.17
 * Time: 11:30
 */

// open file in read-only mode
$sum = 0;
$matrix = fopen("input.txt", "r") or die("Unable to open file!");

// read each text line until end-of-file
while(!feof($matrix)) {
    $line = fgets($matrix);
    $line = trim($line); // trim leading and tailing whitespace

    // http://www.php.net/manual/en/function.preg-split.php
    $array = preg_split("/[\s,]+/", $line); // only whitespace, one or more repetitions
    if (!empty($line)) {
        $sum += max($array) - min($array);
    }
}
fclose($matrix);
echo $sum;