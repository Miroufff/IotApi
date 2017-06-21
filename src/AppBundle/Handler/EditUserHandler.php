<?php

namespace AppBundle\Handler;

use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Model\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditUserFormHandler
 *
 * gestion des évènement de formulaire
 *
 * @package AppBundle\Handler
 *
 * @author  oyacoubi <oyacoubi@leha-labo.com>
 */
class EditUserHandler extends FormHandler
{
    /**
     * @var UserManager $manager
     */
    protected $manager;

    /**
     * @param EntityManager      $manager
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }
    /**
     * @param Customer $user
     */
    protected function onSuccess($user)
    {
        $this->manager->updateUser($user);
    }
}