<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 03.12.17
 * Time: 17:18
 */

$input = 361527;

/**
 * Calculate the manhattan distance
 * @param $input int the value to be found
 * @return float|int the distance
 */
function calc_manhattan_distance($input) {
    // start values
    $value = 1;
    $step = 1;

    // horizontal and vertical distance
    $horizontal = 0;
    $vertical = 0;

    while ($value !== $input) {

        // each step distance is applied twice (1. horizontal, 2. vertical)
        for ($i = 0; $i < 2; $i++) {

            for ($k = 0; $k < $step; $k++) {
                $value++;

                // right or top (uneven)
                if ($step % 2 !== 0) {
                    if ($i % 2 === 0) {
                        $horizontal++;
                    } else {
                        $vertical++;
                    }
                } else {
                    // left or down
                    if ($i % 2 === 0) {
                        $horizontal--;
                    } else {
                        $vertical--;
                    }
                }

                // value found
                if ($value === $input) {
                    return abs($horizontal) + abs($vertical);
                }
            }
        }
        $step++;
    }
}

$distance = calc_manhattan_distance($input);
echo "Input: " . $input . " manhattan distance: " . $distance . "<br/><hr>";

// part two
echo "Part two: <br/>";
echo "adjacent cell sum: " + calc_adjacent_values($input);

/**
 * Iterate from the center of a large matrix and calculate the sum from the surrounding cells,
 * that have an offset of 1.
 * @param $find_value
 * @return int value - the exact neighbour that is large then the given @find_value
 */
function calc_adjacent_values($find_value) {
    // calculated + roofed from the given example (values, dimension 5x5)
    define("MATRIX_DIMENSION", 2000);

    // start values
    $value = 1;
    $step = 1;
    $mega_array = array();

    // horizontal and vertical offsets
    $horizontal = 0;
    $vertical = 0;

    // array init
    $line_array_zeros = array_fill(0, MATRIX_DIMENSION, 0);
    for ($i = 0; $i < MATRIX_DIMENSION; $i++) {
        // push new element to the end of the big array
        $mega_array[] = $line_array_zeros;
    }
    // starting point of the iteration
    $mega_array[MATRIX_DIMENSION / 2][MATRIX_DIMENSION / 2] = 1;

    // fill in with values
    while ($value <= $find_value) {

        // each step distance is applied twice (1. horizontal, 2. vertical)
        for ($i = 0; $i < 2; $i++) {

            for ($k = 0; $k < $step; $k++) {

                // calculate the index
                if ($step % 2 !== 0) {
                    if ($i % 2 === 0) {
                        // right
                        $horizontal++;
                    } else {
                        // up
                        $vertical--;
                    }
                } else {
                    if ($i % 2 === 0) {
                        // left
                        $horizontal--;
                    } else {
                        // down
                        $vertical++;
                    }
                }

                // call helper function to get values from surrounding cells
                $row = (MATRIX_DIMENSION / 2) + $vertical;
                $column = (MATRIX_DIMENSION / 2) + $horizontal;
                $value = sum_adjacent_cells($mega_array, $row, $column);

                // set the new value
                $mega_array[$row][$column] = $value;

                // value found
                if ($value > $find_value) {
                    return $value;
                }
            }
        }
        $step++;
    }
}

/**
 * Sum up to get values from surrounding 8 cells
 * @param $matrix
 * @param $row
 * @param $column
 * @return int sum
 */
function sum_adjacent_cells($matrix, $row, $column) {

    $sum = 0;

    // offsets clockwise
    $sum += $matrix[$row][$column - 1];
    $sum += $matrix[$row - 1][$column - 1];
    $sum += $matrix[$row - 1][$column];
    $sum += $matrix[$row - 1][$column + 1];
    $sum += $matrix[$row][$column + 1];
    $sum += $matrix[$row + 1][$column + 1];
    $sum += $matrix[$row + 1][$column];
    $sum += $matrix[$row + 1][$column - 1];

    return $sum;
}