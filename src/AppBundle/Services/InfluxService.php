<?php

namespace AppBundle\Services;

use AppBundle\Entity\Sensor;
use InfluxDB\Database;
use InfluxDB\Point;

/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 18/05/17
 * Time: 16:08
 */
class InfluxService
{
    /**
     * @var Database $influxManager
     */
    private $influxManager;

    /**
     * InfluxService constructor.
     *
     * @var $influxManager
     */
    public function __construct(Database $influxManager)
    {
        $this->influxManager = $influxManager;
    }

    /**
     * @param $measurement
     * @param $value
     * @param $sensor
     * @param $receivedAt
     */
    public function persist($measurement, $value, Sensor $sensor, $receivedAt)
    {
        $this->influxManager->writePoints(
            [new Point(
                $measurement, // name of the measurement
                $value,// the measurement value
            ['sensor' => $sensor->getId()], // optional additional fields
            [],
            $receivedAt
        )]);
    }
}