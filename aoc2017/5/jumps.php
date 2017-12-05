<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 05.12.17
 * Time: 09:32
 */

$input = fopen("input.txt", "r") or die("Unable to open file!");
$array = array();

// read each text line until end-of-file
while (!feof($input)) {
    $line = fgets($input);
    $line = trim($line); // trim leading and tailing whitespace

    // test for real content
    if (strlen($line) !== 0) {
        $array[] = intval($line);
    }
}

echo "steps: " . count_steps_to_exit($array);

function count_steps_to_exit($array) {

    $array_length = count($array);
    $index = 0;
    $steps = 0;

    while ($index >= 0 && $index < $array_length) {

        $offset = $array[$index];
        $next_pos = $index + $offset;

        // increment steps & visited jump instr.
        $steps++;

        // part two
        if ($offset >= 3) {
            $array[$index]--;
        } else {
            // part one (was just done every time)
            $array[$index]++;
        }

        // jump to exit
        if ($next_pos < 0 || $next_pos >= $array_length) {
            return $steps;
        }

        // update to next index
        $index = $next_pos;
    }
}
