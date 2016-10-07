<?php
/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:25
 *
 * TASK:
 * We have some customer records in a text file (customers.json) -- one customer per line, JSON-encoded.
 * We want to invite any customer within 100km of our Dublin office for some food and drinks on us.
 * Write a program that will read the full list of customers and output the names and user ids of matching
 * customers (within 100km), sorted by User ID (ascending).
 * - You can use the first formula from this Wikipedia article to calculate distance.
 *   Don't forget, you'll need to convert degrees to radians.
 * - The GPS coordinates for our Dublin office are 53.3393,-6.2576841.
 * - You can find the Customer list here.
 */

require_once("LatLng.php");

$testCases = [
    [ "coord" => "52.3191841,-8.5072391", "withinBounds" => false],
    [ "coord" => "52.986375,-6.043701",   "withinBounds" => true],
    [ "coord" => "53.2451022,-6.238335",  "withinBounds" => true],
    [ "coord" => "51.92893,-10.27699",    "withinBounds" => false],
    [ "coord" => "51.802,-9.442",         "withinBounds" => false],
];

$count = 0;
$intercomCoord = new LatLng(53.3393, -6.2576841);
foreach ($testCases as $testCase) {
    $testCoord = LatLng::createFromString($testCase['coord']);
    if ($testCase['withinBounds'] === $intercomCoord->isInBounds($testCoord)) {
        $count++;
    }
}
echo "Test Cases PASSED: {$count}\n";
echo "Test Cases FAILED: ".(count($testCases) - $count)."\n";