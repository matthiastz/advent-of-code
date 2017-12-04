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
    // start value
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
echo "Input: " . $input . " manhattan distance: " . $distance;