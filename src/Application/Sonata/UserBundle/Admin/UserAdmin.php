<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends SonataUserAdmin
{
    /**
        * {@inheritdoc}
        */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
        	->tab('User') // the tab call is optional
        	->with('General')
            ->add('cliente', null, array('label' => 'Cliente'))
            ->add('type', null, array('label' => 'Tipo (0 Market - 1 Empresa - 2 Colaborador)'))
        ;
    }
}