<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Day 1</title>
</head>
<body>
<form>
    puzzle input: <input type="text" name="PuzzleInput"><br>
    <!-- input type="submit" value="Submit" -->
</form>

<?php

$input = $_GET['PuzzleInput'];  // get content of the input field (string) via GET
$array = str_split($input); // split each string part to an array

// TODO: use submit button & append this function
$sum = calc_sum($array);
echo "sum result: " . $sum;

/**
 * @param $array array containing all numbers
 * @return int the calculated sum
 */
function calc_sum($array) {
    $sum = 0;
    $array_length = count($array);

    // iterate from first to last - 1 element (prevent array index overflow)
    for ($i = 0; $i < $array_length - 1; $i++) {
        if ($array[$i] == $array[$i+1]) {
            $sum += $array[$i];
        }
    }

    // test if first and last element are the same value
    if ($array[0] == $array[$array_length - 1]) {
        $sum += $array[0];
    }

    return $sum;
}

?>


</body>
</html>