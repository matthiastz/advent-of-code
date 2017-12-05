<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 04.12.17
 * Time: 11:39
 */

$input = fopen("input.txt", "r") or die("Unable to open file!");
$no_duplicate_phrases = 0;
$no_anagram_phrases = 0;

// read each text line until end-of-file
while (!feof($input)) {
    $line = fgets($input);
    $line = trim($line); // trim leading and tailing whitespace

    // http://www.php.net/manual/en/function.preg-split.php
    $array = preg_split("/[\s,]+/", $line); // only whitespace, one or more repetitions

    if (!empty($line)) {
        if (!line_contains_duplicate($array)) {
            $no_duplicate_phrases++;
        }
        if (!line_contains_anagrams($array)) {
            $no_anagram_phrases++;
        }
    }
}

echo "valid passphrases: " . $no_duplicate_phrases . "<br/>";
echo "no anagram passphrases: " . $no_anagram_phrases . "<br/>";

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

// part two


function line_contains_anagrams($array) {
    $array_length = count($array);

    for ($i = 0; $i < $array_length; $i++) {

        // don't the compare the identical word
        for ($k = $i + 1; $k < $array_length; $k++) {

            // test anagram
            if (words_are_anagrams($array[$i], $array[$k])) {
                return true;
            }
        }
    }
    return false;
}

function words_are_anagrams($word1, $word2) {

    if (strlen($word1) !== strlen($word2)) {
        return false;
    }

    // compare the occurrence of each character in both words
    for ($i = 0; $i < strlen($word1); $i++) {
        $letter = $word1[$i];

        if (letter_occurrence($word1, $letter) !== letter_occurrence($word2, $letter)) {
            return false;
        }
    }
    return true;
}

/**
 * Check how often a given letter is found in a given word
 * @param $word
 * @param $letter
 * @return
 */
function letter_occurrence($word, $letter) {

    $found = 0;

    for ($i = 0; $i < strlen($word); $i++) {
        if ($word[$i] === $letter) {
            $found++;
        }
    }
    return $found;
}