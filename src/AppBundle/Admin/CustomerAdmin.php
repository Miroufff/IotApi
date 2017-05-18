<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 21/02/17
 * Time: 12:27
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CustomerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	$formMapper
		->add('firstname', 'text')
		->add('lastname', 'text')
		->add('username', 'text')
		->add('email', 'text')
		->add('password', 'password');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username');
    }
}
