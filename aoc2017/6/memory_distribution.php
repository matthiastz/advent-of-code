<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 06.12.17
 * Time: 09:59
 */

$file = fopen("input.txt", "r")  or die("Unable to open file!");
$memory = fgets($file); // get the first line
$memory = trim($memory);

$array = preg_split("/[\s,]+/", $memory); // only whitespace, one or more repetitions

// cast to number
for ($i = 0; $i < count($array); $i++) {
    $array[$i] = intval($array[$i]);
}

list($steps, $cycles) = count_steps_memory_distribution($array);
echo "steps: {$steps}" . "<br/>" . "cycles: {$cycles}";


function count_steps_memory_distribution($array) {
    $steps = 0; // part one
    $array_length = count($array);

    if ($array_length <= 1) {
        return -1;
    }

    // save the known distributions
    $known_distributions = array();

    while (true) {

        $max_value = max($array);
        $max_value_pos = array_search($max_value, $array);
        $array[$max_value_pos] = 0;

        // max found
        if ($max_value_pos !== false) {

            // $cycles += floor($max_value / $array_length);

            // distribution loop
            for ($i = 1; $max_value > 0; $i++) {
                $current_pos = ($max_value_pos + $i) % $array_length;
                $array[$current_pos]++;
                $max_value--;
            }

            $steps++;

            // test if one of the known distributions === actual array
            foreach ($known_distributions as $item) {

                if (arrays_equal_values($item, $array)) {
                    // steps from first occurrence of the array to end
                    $cycles = count($known_distributions) - array_search($item, $known_distributions);
                    return array($steps, $cycles);
                }
            }

            // save known distribution
            $known_distributions[] = $array;
        }
    }   // end while
}

function arrays_equal_values($array1, $array2) {

    if (count($array1) != count($array2)) {
        return false;
    }

    for ($i = 0; $i < count($array1); $i++) {
        if ($array1[$i] !== $array2[$i]) {
            return false;
        }
    }
    return true;
}