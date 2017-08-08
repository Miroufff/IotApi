<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rhumsaa\Uuid\Uuid;

/**
 * Sensor
 *
 * @ORM\Table(name="sensor")
 * @ORM\Entity
 */
class Sensor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=2048)
     */
    private $displayname;
  
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=2048)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=512, nullable=true)
     */
    private $vendor;

    /**
     * @var string 
     *
     * @ORM\Column(name="product", type="string", length=512, nullable=true)
     */
    private $product;

    /**

     * @var integer
     *
     * @ORM\Column(name="version", type="string", length=512, nullable=false)
     */
    private $version;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false, options={"default"=true})
     */
    private $enable;

    /**
      * @var Customer
      *
      * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer", cascade={"persist"})
      */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DataSensor", mappedBy="sensor")
     */
    private $dataSensors;

    /**
     * Constructor
     */
    public function __construct() {
        $this->uuid =  Uuid::uuid1();
	    $this->enable = true;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set displayname
     *
     * @param string $displayname
     *
     * @return Sensor
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;

        return $this;
    }

    /**
     * Get displayname
     *
     * @return string 
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }
    
    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Sensor
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set vendor
     *
     * @param string $vendor
     * @return Sensor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set product
     *
     * @param integer $product
     * @return Sensor
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return integer
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return Sensor
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Sensor
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getDataSensors()
    {
        return $this->dataSensors;
    }

    /**
     * @param mixed $dataSensors
     */
    public function setDataSensors($dataSensors)
    {
        $this->dataSensors = $dataSensors;
    }
}
