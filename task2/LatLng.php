<?php

/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:11
 *
 *
 * LatLng
 */
class LatLng
{
    /**
     * @var integer radius
     */
    private $_radius = 100;
    /**
     * @var float latitude
     */
    private $_lat;
    /**
     * @var float longitude
     */
    private $_lng;

    public function __construct($lat, $lng)
    {
        $this->setLat($lat);
        $this->setLng($lng);
    }

    /**
     * @return float the latitude
     */
    public function getLat()
    {
        return $this->_lat;
    }

    /**
     * @param float $value sets the latitude
     */
    public function setLat($value)
    {
        $this->_lat = floatval($value);
    }

    /**
     * @return float the longitude
     */
    public function getLng()
    {
        return $this->_lng;
    }

    /**
     * @param float $value sets the longitude
     */
    public function setLng($value)
    {
        $this->_lng = floatval($value);
    }

    /**
     * @return int the radius
     */
    public function getRadius()
    {
        return $this->_radius;
    }

    /**
     * @param float $value sets the longitude
     */
    public function setRadius($value)
    {
        $this->_radius = intval($value);
    }

    /**
     * Returns true if coordinate is within bounds
     *
     * @param LatLng $coord
     *
     * @return bool whether is inside of boundaries or not
     */
    public function isInBounds(LatLng $coord) {
        return  $this->exactDistanceSLCFrom($coord) <= $this->getRadius();
    }

    /**
     * Exact distance with spherical law of cosines
     *
     * @param LatLng $coord
     *
     * @return float
     */
    public function exactDistanceSLCFrom(LatLng $coord)
    {
        $lat1 = $this->getLat();
        $lon1 = $this->getLng();

        $lat2 = $coord->getLat();
        $lon2 = $coord->getLng();

        $theta = $lon1 - $lon2;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);

        //distsance in kilometers
        return $dist * 60 * 1.1515 * 1.609344;
    }

    /**
     * Creates a LatLng object from a string. For example:
     *
     * ```
     * $coord = LatLng::createFromString('-3.89,3.22');
     * ```
     *
     * @param string $value
     *
     * @return LatLng|null
     */
    public static function createFromString($value)
    {
        $coord = explode(',', $value);
        if (count($coord) == 2) {
            $lat = floatval(trim($coord[0]));
            $lng = floatval(trim($coord[1]));
            return new self($lat, $lng);
        }
        return null;
    }
}