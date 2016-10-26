<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Sensor;

class LoadCustomerData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$sensor = new Sensor();
		$sensor->setDisplayName("firstSensor");
		$sensor->setVersion(1);
		$sensor->setEnable(true);

		$user1 = new Customer();
		$user1->setUsername("mirouf");
		$user1->setPassword("password");
		$user1->setEmail("mirouf@mail.com");
		$user1->setSensor($sensor);

		$manager->persist($sensor);
		$manager->persist($user1);
		$manager->flush();
	}

}
