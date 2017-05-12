<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use AppBundle\Entity\Sensor;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=512, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=512, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="realm", type="string", length=512, nullable=true)
     */
    private $realm;

    /**
     * @var string
     *
     * @ORM\Column(name="credentials", type="text", length=65535, nullable=true)
     */
    private $credentials;

    /**
     * @var string
     *
     * @ORM\Column(name="challenges", type="text", length=65535, nullable=true)
     */
    private $challenges;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailVerified", type="boolean", nullable=true)
     */
    private $emailverified;

    /**
     * @var string
     *
     * @ORM\Column(name="verificationToken", type="string", length=512, nullable=true)
     */
    private $verificationtoken;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=512, nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdated", type="datetime", nullable=true)
     */
    private $lastupdated;

    public function __construct()
    {
	    parent::__construct();
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
     * Set firstname
     *
     * @param string $firstname
     * @return Customer
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Customer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set realm
     *
     * @param string $realm
     * @return Customer
     */
    public function setRealm($realm)
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Get realm
     *
     * @return string 
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Customer
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set credentials
     *
     * @param string $credentials
     * @return Customer
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * Get credentials
     *
     * @return string 
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set challenges
     *
     * @param string $challenges
     * @return Customer
     */
    public function setChallenges($challenges)
    {
        $this->challenges = $challenges;

        return $this;
    }

    /**
     * Get challenges
     *
     * @return string 
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set emailverified
     *
     * @param boolean $emailverified
     * @return Customer
     */
    public function setEmailverified($emailverified)
    {
        $this->emailverified = $emailverified;

        return $this;
    }

    /**
     * Get emailverified
     *
     * @return boolean 
     */
    public function getEmailverified()
    {
        return $this->emailverified;
    }

    /**
     * Set verificationtoken
     *
     * @param string $verificationtoken
     * @return Customer
     */
    public function setVerificationtoken($verificationtoken)
    {
        $this->verificationtoken = $verificationtoken;

        return $this;
    }

    /**
     * Get verificationtoken
     *
     * @return string 
     */
    public function getVerificationtoken()
    {
        return $this->verificationtoken;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Customer
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Customer
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set lastupdated
     *
     * @param \DateTime $lastupdated
     * @return Customer
     */
    public function setLastupdated($lastupdated)
    {
        $this->lastupdated = $lastupdated;

        return $this;
    }

    /**
     * Get lastupdated
     *
     * @return \DateTime 
     */
    public function getLastupdated()
    {
        return $this->lastupdated;
    }

    /**
     * Set Sensor
     *
     * @param Sensor $sensor
     * @return Customer
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * Get Sensor
     *
     * @return Sensor 
     */
    public function getSensor()
    {
        return $this->sensor;
    }
}
