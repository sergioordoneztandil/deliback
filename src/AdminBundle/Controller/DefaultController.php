<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Empleado;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('CoreBundle:Cliente')->findAll();

        foreach($clientes as $cliente) {
            for($i = 933; $i < 998; $i++) {
                $empleado = new Empleado();
                $empleado->setLegajo('0'.$cliente->getId().'00'.$i);
                $empleado->setNombre('Empleado'.$i);
                $empleado->setCliente($cliente);
                $em->persist($empleado);
            }
        }
        $em->flush();
        die('AY');
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));

        
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    /**
     * @Route("/pedidoa")
     */
    public function pedidoAAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menues = $em->getRepository('CoreBundle:Menu')->findAll();
        
        return $this->render('AdminBundle:Default:pedidoA.html.twig',
            array(
                'menues' => $menues,
            )
        );
    }
}
