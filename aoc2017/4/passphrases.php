<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 04.12.17
 * Time: 11:39
 */

$input = fopen("input.txt", "r") or die("Unable to open file!");
$valid_phrases = 0;

// read each text line until end-of-file
while(!feof($input)) {
    $line = fgets($input);
    $line = trim($line); // trim leading and tailing whitespace

    // http://www.php.net/manual/en/function.preg-split.php
    $array = preg_split("/[\s,]+/", $line); // only whitespace, one or more repetitions

    if (!empty($line)) {
        if (!line_contains_duplicate($array)) {
            $valid_phrases++;
        }
    }
}

echo "valid passphrases: " . $valid_phrases;

/**
 * Test if the given array contains duplicate(s) or not
 * @param $array
 * @return bool
 */
function line_contains_duplicate($array) {
    $array_length = count($array);

    for ($i = 0; $i < $array_length; $i++) {

        // don't the compare the identical word
        for ($k = $i + 1; $k < $array_length; $k++) {
            if ($array[$i] === $array[$k]) {
                return true;
            }
        }
    }
    return false;
}