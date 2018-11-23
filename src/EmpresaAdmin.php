<?php

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EmpresaAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre')
            ->add('logo')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombre')
            ->add('logo')
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
        $image = null;
        $subject = $this->getSubject();

    	if($subject) {
            $image = $this->getSubject()->getLogo();
    	}
    	$fileFieldOptionsImage = array(
    			'required' => false,
    			'provider' => 'sonata.media.provider.image',
    			'context'  => 'logoempresa'
        );
        $container = $this->getConfigurationPool()->getContainer();
    	if ($image && ($webPath = $container->get('sonata.media.twig.extension')->path($image, 'reference'))) {
    		
    		$fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().$webPath;
    		 
    		$fileFieldOptionsImage['help'] = '<img src="'.$fullPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('nombre')
            ->add('logo', 'sonata_media_type', $fileFieldOptionsImage)
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
            ->add('logo')
        ;
    }
}
