<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Customer;

class LoadCustomerData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$user1 = new Customer();

		$manager->persist($user1);
		$manager->flush();
	}

}
