<?php

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MenuAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('cliente')
            ->add('nombre')
            ->add('dia')
            ->add('semanaNro')
            ->add('semanaNroAnio')
            ->add('observaciones')
            ->add('altaFecha')
            ->add('modificacionFecha')
            ->add('altaUsuario')
            ->add('platos')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('cliente')
            ->add('nombre')
            ->add('dia')
            ->add('semanaNro')
            ->add('semanaNroAnio')
            ->add('observaciones')
            ->add('altaFecha')
            ->add('modificacionFecha')
            ->add('altaUsuario')
            ->add('platos')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('cliente')
            ->add('nombre')
            ->add('dia')
            ->add('semanaNro')
            ->add('semanaNroAnio')
            ->add('observaciones')
            ->add('altaFecha')
            ->add('modificacionFecha')
            ->add('altaUsuario')
            ->add('platos')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('cliente')
            ->add('nombre')
            ->add('dia')
            ->add('semanaNro')
            ->add('semanaNroAnio')
            ->add('observaciones')
            ->add('altaFecha')
            ->add('modificacionFecha')
            ->add('altaUsuario')
            ->add('platos')
        ;
    }
}
