<?php
/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:25
 *
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