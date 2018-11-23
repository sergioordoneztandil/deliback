<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\UserBundle\Admin\Model\GroupAdmin as SonataGroupAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class GroupAdmin extends SonataGroupAdmin
{
    /**
        * {@inheritdoc}
        */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $securityRolesType = method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')
            ? 'Sonata\UserBundle\Form\Type\SecurityRolesType'
            : 'sonata_security_roles';

        $formMapper
            ->tab('Group')
                ->with('General', ['class' => 'col-md-6'])
                    ->add('name')
                    ->add('perfil', null, array('label' => 'Perfil'))
                ->end()
            ->end()
            ->tab('Security')
                ->with('Roles', ['class' => 'col-md-12'])
                    ->add('roles', $securityRolesType, [
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false,
                    ])
                ->end()
            ->end();
    }
    
}
