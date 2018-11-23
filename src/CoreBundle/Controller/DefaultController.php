<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Plato;
use CoreBundle\Entity\Menu;

class DefaultController extends Controller
{

    /**
     * @Route("/addmenues")
     */
    public function addMenuesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('CoreBundle:Cliente')->findAll();

        $platos = $em->getRepository('CoreBundle:Plato')->findAll();

        foreach($clientes as $cliente) {
            $startDate = new \Datetime();

            for($i=1; $i<= 15; $i++) {
                $menu = new Menu();

                $menu->setCliente($cliente);
                $menu->setNombre('Menu '.$cliente->getNombre());
                $menu->setDia(new \Datetime($startDate->format('Y-m-d')));
                $menu->setSemanaNro(1);
                $menu->setSemanaNroAnio($startDate->format("W"));
                $menu->setObservaciones('observaciones');
                $menu->setAltaFecha(new \Datetime());
                $menu->setModificacionFecha(new \Datetime());
                $menu->setAltaUsuario('altaUsuario');
                $menu->setIdFM(1);

                foreach($platos as $plato) {
                    $menu->addPlato($plato);
                }
                $em->persist($menu);
                $startDate->add(new \DateInterval('P1D'));
            }
        }
        
        $em->flush();

        return $this->render('CoreBundle:Default:index.html.twig');
    }
    /**
     * @Route("/migrarplatos")
     */
    public function addPlatosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $directorio = "uploads/menues/";
        $gestor_dir = opendir($directorio);
        while (false !== ($nombre_fichero = readdir($gestor_dir))) {
            if($nombre_fichero != '.' && $nombre_fichero != '..' && $nombre_fichero != 'DSC_9557') {
                $mediaManager = $this->get("sonata.media.manager.media");
                $media = new \Application\Sonata\MediaBundle\Entity\Media();

                $media->setBinaryContent($directorio.$nombre_fichero);
                $media->setContext('imgproducto'); //contex you are using
                $media->setProviderName('sonata.media.provider.image');

                $mediaManager->save($media);
                $em->persist($media);

                $nombre_fichero = str_replace('.JPG', '', $nombre_fichero);
                $nombre_fichero = str_replace('.jpg', '', $nombre_fichero);
                $nombre_fichero = str_replace('.PNG', '', $nombre_fichero);
                $nombre_fichero = str_replace('.png', '', $nombre_fichero);
                $nombre_fichero = str_replace('LOGO', '', $nombre_fichero);
                $nombre_fichero = trim($nombre_fichero);
                echo($nombre_fichero.'<br/>'); 

                $plato = new Plato;
                $plato->setNombre($nombre_fichero);
                $plato->setImagen($media);
                $plato->setIdFM(1);
                $plato->setDefaultValue(0);
                $plato->setTipo(0);
                $em->persist($plato);
            }            
        }
        $em->flush();
        return $this->render('CoreBundle:Default:index.html.twig');
    }

    private function saveImage($path) {
        $item; //Entity where you added Sonata Media field
        $mediaManager = $this->get("sonata.media.manager.media");
        $media = new \Application\Sonata\MediaBundle\Entity\Media();

        $media->setBinaryContent($path);
        $media->setContext('imgproducto'); //contex you are using
        $media->setProviderName('sonata.media.provider.image');

        $mediaManager->save($media);

        //$item->setImage($media);
        //call entity manager and save object
    }
}
