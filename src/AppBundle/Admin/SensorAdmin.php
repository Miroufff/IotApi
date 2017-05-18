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

class SensorAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	$formMapper
		->add('displayname', 'text')
		->add('vendor', 'text')
		->add('product', 'text')
		->add('version', 'text')
		->add('enable', 'text')
        ->add('customer', 'sonata_type_model_list', array(), array(
            'placeholder' => 'No customer selected'
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('displayname')->add('customer.username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('displayname')
            ->add('customer.username')
            ->add('_action', 'actions', array('actions' => array(
                'show' => array(),
                'edit' => array(),
            ))
        );
    }
}
