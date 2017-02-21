<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DataSensor
 *
 * @ORM\Table(name="data_sensor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DataSensorRepository")
 */
class DataSensor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * Client à qui on assigne la fea
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sensor", inversedBy="dataSensors")
     * @ORM\JoinColumn(name="sensor_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $sensor;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return DataSensor
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set sensor
     *
     * @param \stdClass $sensor
     *
     * @return DataSensor
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * Get sensor
     *
     * @return \stdClass
     */
    public function getSensor()
    {
        return $this->sensor;
    }
}

