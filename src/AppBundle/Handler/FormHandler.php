<?php

namespace AppBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class FormHandler
 *
 * gestion des évènement de formulaire
 *
 * @package AppBundle\Handler
 *
 * @author  oyacoubi <oyacoubi@leha-labo.com>
 */
class FormHandler
{
    protected $request;
    protected $form;
    protected $manager;
    /**
     * Constructor
     *
     * @param EntityManager $manager
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    /**
     * S'occupe de gérer le post du formulaire et sa validation
     *
     * @param Request       $request
     * @param FormInterface $form
     *
     * @return bool|null
     */
    public function process(Request $request, FormInterface $form)
    {
        $this->form = $form;

        if ($request->isMethod('POST')) {
            if (count($request->request->all()) === 0) {
                return null;
            }

            $form->handleRequest($request);

            if ($form->isValid()) {
                $entity = $form->getData();

                if ($this->postValidate($form)) {
                    $this->onSuccess($entity);

                    return true;
                }
            }
        }

        return false;
    }
}