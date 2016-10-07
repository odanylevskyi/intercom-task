<?php
/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 08:35
 *
 * TASK:
 * Write a function that will flatten an array of arbitrarily nested arrays of integers into a flat array
 * of integers. e.g. [[1,2,[3]],4] → [1,2,3,4]. If the language you're using has a function to flatten arrays,
 * you should pretend it doesn't exist.
 *
 */


/*
 * Flatten an array of arbitrarily nested arrays of integers into a flat array of integers.
 *
 * @param array - nested arrays
 *
 * @return array - a flat array of integers
 */
function toFlatArray(array $nestedArray) {
    if(empty($nestedArray)) {
        return [];
    }
    $flatArray  = array();
    $i = 0;
    while($i < count($nestedArray)) {
        $tmp = $nestedArray[$i++];
        if (is_array($tmp)) {
            $result = toFlatArray($tmp);
            for($j = 0; $j < count($result); $j++) {
                $flatArray[] = $result[$j];
            }
        } else {
            $flatArray[] = $tmp;
        }
    }

    return $flatArray;
}


$flatArray = toFlatArray([[[[[1, 2, 3, 4, 5, 6, 7, 8]]]]]);
print_r($flatArray);

//Test cases
$nestedArrays = [
    [1, 2, 3, 4, 5, 6, 7, 8],
    [[[[[1, 2, 3, 4, 5, 6, 7, 8]]]]],
    [1, 2, 3, [4, [5, 6], [[7]]], 8],
    [1, [2, [3, [4, [5, 6, 7]]], 8]],
    [[1, [2, [3], 4]], [5,6], [7], 8],
    [[1,2,[3]],4, 5, 6, 7, [8]],
    [[1], [2], [3], [4], [5], [6], [7], [8]],
];
$count = 0;
foreach ($nestedArrays as $nestedArray) {
    try {
        $flatArray = toFlatArray($nestedArray);
        if ($flatArray === [1,2,3,4,5,6,7,8]) {
            $count++;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
$nestedArraysEmpty = [
    [[[[]]],[],[]],
    [[[[]]]],
    []
];
foreach ($nestedArraysEmpty as $nestedArray) {
    try {
        $flatArray = toFlatArray($nestedArray);
        if ($flatArray === []) {
            $count++;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
echo "Test Cases PASSED: {$count}\n";
echo "Test Cases FAILED: ".(count($nestedArrays)+count($nestedArraysEmpty) - $count)."\n";