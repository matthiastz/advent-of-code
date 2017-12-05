<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 03.12.17
 * Time: 11:30
 */

// open file in read-only mode
$sum = 0;
$even_sum = 0;
$matrix = fopen("input.txt", "r") or die("Unable to open file!");

// read each text line until end-of-file
while (!feof($matrix)) {
    $line = fgets($matrix);
    $line = trim($line); // trim leading and tailing whitespace

    // http://www.php.net/manual/en/function.preg-split.php
    $array = preg_split("/[\s,]+/", $line); // only whitespace, one or more repetitions
    $array_length = count($array);

    // convert string elements to int
    for ($i = 0; $i < $array_length; $i++) {
        $array[$i] = (int) $array[$i];
    }

    if (!empty($line)) {
        $sum += max($array) - min($array);
    }

    // part two
    $even_sum += calc_evendiv($array);
}
fclose($matrix);
echo "checksum: " . $sum . "<br/>";
echo "even sum: " . $even_sum;

/**
 * Find evenly divisible numbers and calculate this divison
 * @param $array
 * @return float|int
 */
function calc_evendiv($array) {
    $array_length = count($array);

    if ($array_length >= 2) {
        for ($i = 0; $i < $array_length; $i++) {
            for ($k = 0; $k < $array_length; $k++) {

                // don't divide x/x
                if ($i === $k) {
                    continue;
                }

                if ($array[$i] % $array[$k] === 0) {
                    if ($array[$k] !== 0) {
                        return $array[$i] / $array[$k];
                    }
                } elseif ($array[$k] % $array[$i] === 0) {
                    if ($array[$i] !== 0) {
                        return $array[$k] / $array[$i];
                    }
                }
            }
        }
    }
}