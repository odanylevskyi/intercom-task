<?php
/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:01
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

require_once("Controller.php");

try {
    $controller = new Controller();
    $invitedCustomers = $controller->run();
    foreach ($invitedCustomers as $id => $name) {
        print "{$name} (ID: {$id})\n";
    }
} catch (FileNotFoundException $e) {
    print $e->getMessage();
}

