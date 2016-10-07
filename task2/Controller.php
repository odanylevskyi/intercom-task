<?php

/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 10/7/2016
 * Time: 09:02 PM
 */

require_once("FileReader.php");
require_once("LatLng.php");

class Controller
{
    /*
     * Process json-file and get customers  within bounds
     *
     * @return array invited customers list
     */
    public function run() {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'customer.json';
        $reader = new FileReader($file);

        $intercomCoord = new LatLng(53.3393, -6.2576841);
        $invitedCustomers = [];
        while(!$reader->eof()) {
            $customer = json_decode($reader->readLine());
            if ($customer && $this->checkAttributesExists($customer) && $this->validateAttributes($customer)) {
                $customerCoord = new LatLng($customer->latitude, $customer->longitude);
                if ($intercomCoord->isInBounds($customerCoord)) {
                    $invitedCustomers[$customer->user_id] = $customer->name;
                }
            }
        }
        ksort($invitedCustomers);

        return $invitedCustomers;
    }

    /**
     * Validates a given customer object.
     *
     * @param $customer customer data to be validated.
     *
     * @return boolean whether the data is valid.
     */
    private function validateAttributes($customer) {
        return strlen($customer->latitude) > 0 && strlen($customer->longitude) > 0 &&
               strlen($customer->name) > 0 && is_integer($customer->user_id);
    }

    /**
     * Validates a given customer object attributes exist.
     *
     * @param $customer customer data to be checked.
     *
     * @return boolean whether all attributes exist.
     */
    private function checkAttributesExists($customer) {
        return isset($customer->latitude) && isset($customer->longitude) && isset($customer->name) && isset($customer->user_id);
    }
}