<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreBundle\Entity\Menu;
use CoreBundle\Entity\Plato;
use CoreBundle\Entity\Cliente;
use CoreBundle\Entity\Pedido;
use CoreBundle\Entity\PedidoItem;

/**
 * @Route("/api")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/insert")
     */
    public function insertAction()
    {
        
        $anio = 2018;
        $dayOfWeek = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
        $dayOfWeekOpts = array('Op', 'PostreOp');
        $dayOfWeekCount = array(1, 2, 3, 4, 5);

    	$em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        /*
    	http://test01.vanrec.com.ar/api/insert?menues=[{
            'idMenuGen':'idMenuGen',
            'nombre':'nombre',
            'cliente':'cliente',
            'codigocuenta':'codigoCuenta',
            'semananro':'semananro',
            'semananroanio':'semananroanio',
            'Observaciones':'observaciones',
            'altafecha':'',
            'modificacionfecha':'',
            'altausuario':'altausuario',
            'LunesOp1':'lunesOp1','LunesOp1ID':'lunesOp1ID','LunesOp2':'lunesOp2','LunesOp2ID':'lunesOp2ID','LunesOp3':'lunesOp3','LunesOp3ID':'lunesOp3ID',
            'LunesPostreOp1':'lunesPostreOp1','LunesPostreOp1ID':'lunesPostreOp1ID','LunesPostreOp2':'lunesPostreOp2','LunesPostreOp2ID':'lunesPostreOp2ID','LunesPostreOp3':'lunesPostreOp3','LunesPostreOp3ID':'lunesPostreOp3ID','MartesOp1':'martesOp1','MartesOp1ID':'martesOp1ID','MartesOp2':'martesOp2','MartesOp2ID':'martesOp2ID','MartesOp3':'martesOp3','MartesOp3ID':'martesOp3ID','MartesPostreOp1':'martesPostreOp1','MartesPostreOp1ID':'martesPostreOp1ID','MartesPostreOp2':'martesPostreOp2','MartesPostreOp2ID':'martesPostreOp2ID','MartesPostreOp3':'martesPostreOp3','MartesPostreOp4ID':'martesPostreOp4ID','MiercolesOp1':'miercolesOp1 ','MiercolesOp1ID':'miercolesOp1ID','MiercolesOp2':'miercolesOp2 ','MiercolesOp2ID':'miercolesOp2ID','MiercolesOp3':'miercolesOp3 ','MiercolesOp3ID':'miercolesOp3ID','MiercolesPostreOp1':'miercolesPostreOp1 ','MiercolesPostreOp1ID':'miercolesPostreOp1ID','MiercolesPostreOp2':'miercolesPostreOp2 ','MiercolesPostreOp2ID':'miercolesPostreOp2ID','MiercolesPostreOp3':'miercolesPostreOp3 ','MiercolesPostreOp4ID':'miercolesPostreOp3ID','JuevesOp1':'juevesOp1','JuevesOp1ID':'juevesOp1ID','JuevesOp2':'juevesOp2','JuevesOp2ID':'juevesOp2ID','JuevesOp3':'juevesOp3','JuevesOp3ID':'juevesOp3ID','JuevesPostreOp1':'juevesPostreOp1','JuevesPostreOp1ID':' juevesPostreOp1ID','JuevesPostreOp2':'juevesPostreOp2','JuevesPostreOp2ID':' juevesPostreOp2ID','JuevesPostreOp3':'juevesPostreOp3','JuevesPostreOp4ID':' juevesPostreOp3ID','ViernesOp1':'viernesOp1','ViernesOp1ID':'viernesOp1ID','ViernesOp2':'viernesOp2','ViernesOp2ID':'viernesOp2ID','ViernesOp3':'viernesOp3','ViernesOp3ID':'viernesOp3ID','ViernesPostreOp1':'viernesPostreOp1','ViernesPostreOp1ID':'viernesPostreOp1ID','ViernesPostreOp2':'viernesPostreOp2','ViernesPostreOp2ID':'viernesPostreOp2ID','ViernesPostreOp3':'viernesPostreOp3','ViernesPostreOp4ID':'viernesPostreOp4ID','SabadoOp1':'sabadoOp1','SabadoOp1ID':'sabadoOp1ID','SabadoOp2':'sabadoOp2','SabadoOp2ID':'sabadoOp2ID','SabadoOp3':'sabadoOp3','SabadoOp3ID':'sabadoOp3ID','SabadoPostreOp1':'sabadoPostreOp1','SabadoPostreOp1ID':'sabadoPostreOp1ID','SabadoPostreOp2':'sabadoPostreOp2','SabadoPostreOp2ID':'sabadoPostreOp2ID','SabadoPostreOp3':'sabadoPostreOp3','SabadoPostreOp4ID':'sabadoPostreOp3ID','DomingoOp1':' domingoOp1','DomingoOp1ID':'domingoOp1ID','DomingoOp2':' domingoOp2','DomingoOp2ID':' domingoOp2ID','DomingoOp3':'domingoOp3','DomingoOp3ID':' domingoOp3ID','DomingoPostreOp1':' domingoPostreOp1','DomingoPostreOp1ID':'domingoPostreOp1ID','DomingoPostreOp2':' domingoPostreOp2','DomingoPostreOp2ID':'domingoPostreOp2ID','DomingoPostreOp3':' domingoPostreOp3','DomingoPostreOp4ID':'domingoPostreOp3ID'}]
        */
        $menues = json_decode($request->get('menues'), true);

        foreach ($menues as $m) {

            foreach($dayOfWeek as $dof) {
                $dia = $this->obtenerDia($m['semananroanio'], $dof, $anio);
                $menu = null;

                if(isset($m['idMenuGen']) && isset($m['semananro']) && isset($m['semananroanio'])) {
                    $menu = $em->getRepository('CoreBundle:Menu')->findOneBy(
                        array(
                            'idFM'=>$m['idMenuGen'],
                            'semanaNro'=>$m['semananro'],
                            'semanaNroAnio'=>$m['semananroanio'],
                            'dia'=>$dia
                        )
                    );
                    if(!$menu) {
                        $menu = new Menu();
                        $menu->setIdFM($m['idMenuGen']);
                        $menu->setSemanaNro($m['semananro']);
                        $menu->setSemanaNroAnio($m['semananroanio']);
                    }
                    
                    $menu->setNombre($m['nombre']);
                    
                    $cliente = $em->getRepository('CoreBundle:Cliente')->findOneBy(
                        array(
                            'codigoCuenta'=>$m['codigocuenta'],
                        )
                    );
                    if(!$cliente) {
                        $cliente = new Cliente();
                        $cliente->setCodigoCuenta($m['codigocuenta']);
                        $cliente->setNombre($m['cliente']);
                        $em->persist($cliente);
                    }
                    $menu->setCliente($cliente);
                    
                    $menu->setDia($dia);
                    $menu->setObservaciones($m['Observaciones']);
                    if($m['altafecha'] != '') {
                        $menu->setAltaFecha(new \DateTime($m['altafecha']));
                    }
                    if($m['modificacionfecha'] != '') {
                        $menu->setModificacionFecha(new \DateTime($m['modificacionfecha']));
                    }
                    
                    $menu->setAltaUsuario($m['altausuario']);
    
                    foreach($dayOfWeekOpts as $dofo) {
                        foreach($dayOfWeekCount as $dofc) {
                            if(isset($m[$dof.$dofo.$dofc.'ID']) && isset($m[$dof.$dofo.$dofc])) {
                                $platoIdFM = $m[$dof.$dofo.$dofc.'ID'];
                                $plato = null;
                                $plato = $em->getRepository('CoreBundle:Plato')->findOneBy(
                                    array(
                                        'idFM'=> $platoIdFM
                                    )
                                );
                                if(!$plato) {
                                    $plato = new Plato();
                                    $plato->setIdFM($platoIdFM);
                                    $plato->setNombre($m[$dof.$dofo.$dofc]);
                                    if($dofc == 1) {
                                        $plato->setDefaultValue(true);
                                    } else {
                                        $plato->setDefaultValue(false);
                                    }
                                    if($dofo == 'Op') {
                                        $plato->setTipo(0);
                                    } else if($dofo == 'PostreOp') {
                                        $plato->setTipo(1);
                                    } else {
                                        $plato->setTipo(2);
                                    }
                                    $em->persist($plato);
                                    $em->flush();
                                }
                                $menu->addPlato($plato);
                            }
                        }
                    }
                    $em->persist($menu);
                    $em->flush();
                }

            }
    	}
    	$em->flush();
    	die('Done.');
        return $this->render('ApiBundle:Default:index.html.twig');
    }

    /* LOGIN */
    /* LOGIN */
    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $email = $data['email'];
        $password = $data['password'];

        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');

        //$user = $user_manager->findUserByUsername($username);
        $user = $user_manager->findUserByUsername($email);

        if($user) {
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();

            if($encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
                $ip = $this->container->get('request')->server->get("REMOTE_ADDR");
                $now = new \DateTime();
                $timestamp = $now->getTimestamp().$email.$ip;
                $token = hash("md2", $timestamp);
                $user->setToken($token);
                $user->setWebsite($ip);
                $em->persist($user);
                $em->flush();

                $cat = array(
                    'email' => $email,
                    'ip' => $ip,
                    'token' => $token,
                    'tipo' => $user->getType(),
                    'loginok' => 'OK',
                );
            } else {
                $cat = array(
                    'msg' => 'Verifique los datos de acceso o Registrese para poder ingresar.',
                );
            }
        } else {
            $cat = array(
                'msg' => 'Verifique los datos de acceso o Registrese para poder ingresar.',
            );
        }

        $response = new Response(json_encode($cat));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $email = $data['email'];
        $token = $data['token'];
        $ip = $this->container->get('request')->server->get("REMOTE_ADDR");

        $usuario = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByUsername($email);

        $cat = array(
            'msg' => 'Verifique los datos de acceso o Registrese para poder ingresar.',
        );

        if($usuario) {
            if (hash_equals($token, $usuario->getToken()) && $ip == $usuario->getWebsite()) {
                $usuario->setToken(null);
                $usuario->setWebsite(null);
                $em->persist($usuario);
                $em->flush();
    
                $cat = array(
                    'email' => $email,
                    'ip' => $ip,
                    'token' => $token,
                    'logoutok' => 'OK',
                );
            }
        }

        $response = new Response(json_encode($cat));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * @Route("/menues")
     */
     public function menuesAction(Request $request)
     {
         $data = json_decode($request->getContent(), true);
         $em = $this->getDoctrine()->getManager();
 
         $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
        
        //NO ES TODO, DEPENDE DEL PERIODO Y TIPO Y CLIENTE
        if ($data['periodo'] > 0) {
            $periodo = $em->getRepository('CoreBundle:Periodo')->findOneById($data['periodo']);
            $rango = $this->getStartEndDays($periodo->getDias());
            $menuesORM = $em->getRepository('CoreBundle:Menu')->findByRango($rango);
        } else if ($usuarioORM->getType() == 0) {
            $menuesORM = $em->getRepository('CoreBundle:Menu')->findForMarket($usuarioORM->getCliente());
        } else { 
            $menuesORM = $em->getRepository('CoreBundle:Menu')->findAll();
        }
        
        
         $menues = array();
         foreach($menuesORM as $menu){
            $platos = array();
            foreach($menu->getPlatos() as $plato){

                $image = $plato->getImagen();
                $format = 'large';
                $provider = $this->container->get($image->getProviderName());
                $format = $provider->getFormatName($image, $format);
                $url = $this->getRequest()->getScheme().'://'.$this->getRequest()->getHost().$provider->generatePublicUrl($image, $format);

                $platos[] = array(
                    'id' => $plato->getId(),
                    'nombre' => $plato->getNombre(),
                    'defaultValue' => $plato->getDefaultValue(),
                    'tipo' => $plato->getTipo(),
                    'url' => $url,
                );
            }
            $menues[] = array(
                'id' => $menu->getId(),
                'nombre' => $menu->getNombre(),
                'dia' => $menu->getDia()->format('d-m-Y'),
                'cliente' => $menu->getCliente()->getNombre(),
                'idCliente' => $menu->getCliente()->getId(),
                'platos' => $platos
            );
         }
         $response = new Response(json_encode($menues));
         $response->headers->set('Access-Control-Allow-Origin', '*');
         return $response;
     }

     /**
     * @Route("/platos")
     */
    public function platosAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $menuesORM = $em->getRepository('CoreBundle:Menu')->findOneById($data['menuid']);
       
        $platos = array();
        
        if($menuesORM) {
            
            $platosORM = $menuesORM->getPlatos();
       
            foreach($platosORM  as $plato){
                $platos[] = array(
                    'id' => $plato->getId(),
                    'nombre' => $plato->getNombre(),
                    'defaultValue' => $plato->getDefaultValue(),
                    'tipo' => $plato->getTipo(),
                );
            }
        }
        

        $response = new Response(json_encode($platos));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

     /**
     * @Route("/empleados")
     */
    public function empleadosAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $cliente = $em->getRepository('CoreBundle:Cliente')->findOneById($data['cliente']);

        $empleadosORM = $em->getRepository('CoreBundle:Empleado')->findByCliente($cliente);
       
        $empleados = array();

        foreach($empleadosORM as $empleado){
           $empleados[] = array(
               'id' => $empleado->getId(),
               'nombre' => $empleado->getNombre(),
               'legajo' => $empleado->getLegajo(),
           );
        }
        $response = new Response(json_encode($empleados));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/secciones")
     */
    public function seccionesAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $cliente = $em->getRepository('CoreBundle:Cliente')->findOneById($data['cliente']);

        $seccionesORM = $cliente->getSecciones();
       
        $secciones = array();

        foreach($seccionesORM as $seccion){
           $secciones[] = array(
               'id' => $seccion->getId(),
               'nombre' => $seccion->getNombre(),
           );
        }
        $response = new Response(json_encode($secciones));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/periodos")
     */
    public function periodosAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $periodosORM = $em->getRepository('CoreBundle:Periodo')->findAll();
       
        $periodos = array();

        foreach($periodosORM as $periodo){
           $periodos[] = array(
               'id' => $periodo->getId(),
               'nombre' => $periodo->getNombre(),
           );
        }
        $response = new Response(json_encode($periodos));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

     /**
     * @Route("/currentuser")
     */
    public function currentUserAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
       
        $minDatePedidos = new \Datetime();
        $minDatePedidos->add(new \DateInterval('P7D'));
        $logoCliente = $usuarioORM->getCliente()->getLogo();
        $logoCliente = $this->container->get('sonata.media.twig.extension')->path($logoCliente, 'reference');
        $logoCliente =  $this->getRequest()->getHost().$logoCliente;
        if ($this->getRequest()->isSecure()) {
            $logoCliente =  'https://'.$logoCliente;
        } else {
            $logoCliente =  'http://'.$logoCliente;
        }
        $usuario = array(
            'id' => $usuarioORM->getId(),
            'username' => $usuarioORM->getUsername(),
            'tipo' => $usuarioORM->getType(),
            'minDatePedido' => $minDatePedidos->format('Y-m-d'),
            'cliente' => array(
                'id' => $usuarioORM->getCliente()->getId(),
                'nombre' => $usuarioORM->getCliente()->getNombre(),
                'codigoCuenta' => $usuarioORM->getCliente()->getCodigoCuenta(),
                'logo' => $logoCliente,
            ),
            'group' => array(
                'id' => $usuarioORM->getGroups()[0]->getId(),
                'name' => $usuarioORM->getGroups()[0]->getName(),
                'perfil' => $usuarioORM->getGroups()[0]->getPerfil(),
            ),
        );

        $response = new Response(json_encode($usuario));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/enviarpedido")
     */
    public function enviarPedidoAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
                'username' => $data['email'],
                'token' => $data['token'],
            )
        );

        if(!$usuarioORM) {
            $response = new Response(json_encode(array('result' => 'KO',)));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
        
        $cesta = $data['cesta'];
        $fechaEntrega = $cesta['fechaEntrega'];
        $cliente = $em->getRepository('CoreBundle:Cliente')->findOneById($cesta['idEmpresa']);
        $pedido = new Pedido();
        $pedido->setUser($usuarioORM);
        $pedido->setCliente($cliente);
        $pedido->setFechaEntrega(new \Datetime($fechaEntrega));
        $pedido->setFechaPedido(new \Datetime());

        $items = $cesta['items'];
        foreach($items as $item){
            $pedidoItem = new PedidoItem();
            $menu = $em->getRepository('CoreBundle:Menu')->findOneById($item['idMenu']);
            $pedidoItem->setMenu($menu);
            $plato = $em->getRepository('CoreBundle:Plato')->findOneById($item['idPlato']);
            $pedidoItem->setPlato($plato);
            $empleado = $em->getRepository('CoreBundle:Empleado')->findOneById($item['idEmpleado']);
            $pedidoItem->setEmpleado($empleado);
            $seccion = $em->getRepository('CoreBundle:Seccion')->findOneById($item['idSeccion']);
            $pedidoItem->setSeccion($seccion);
            $pedidoItem->setCantidad($item['cantidad']);
            $pedidoItem->setDia(new \Datetime($item['dia']));
            $em->persist($pedidoItem);
            $pedido->addItem($pedidoItem);
        }
        $em->persist($pedido);

        $em->flush();

        $response = new Response(json_encode($data));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/historial")
     */
    public function historialAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $usuarioORM = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy( array(
               'username' => $data['email'],
               'token' => $data['token'],
           )
       );

       if(!$usuarioORM) {
           $response = new Response(json_encode(array('result' => 'KO',)));
           $response->headers->set('Access-Control-Allow-Origin', '*');
           return $response;
       }
       
       $pedidosORM = $em->getRepository('CoreBundle:Pedido')->findByUser($usuarioORM);
       
       
        $pedidos = array();
        foreach($pedidosORM as $pedido){
            $pedidoItems = array();
            
            $pedidoItemsORM = $pedido->getItems();
            foreach($pedidoItemsORM as $pedidoItem){    
                $pedidoItems[] = array(
                    'id' => $pedidoItem->getId(),
                    'plato' => $pedidoItem->getPlato()->getNombre(),
                    'cantidad' => $pedidoItem->getCantidad(),
                );
            }
            
            $pedidos[] = array(
                'id' => $pedido->getId(),
                'fechaEntrega' => $pedido->getFechaEntrega()->format('d/m/Y'),
                'fechaPedido' => $pedido->getFechaPedido()->format('d/m/Y H:m'),
                'items' => $pedidoItems,
            );
        }
        $response = new Response(json_encode($pedidos));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    private function obtenerDia($semanaAnio, $nombreDia, $anio) {
        $primerDiaAnio = new \DateTime($anio.'-01-01');
        $diaSemana = 0;
        switch ($nombreDia) {
            case 'Lunes':
                $diaSemana = 0;
                break;
            case 'Martes':
                $diaSemana = 1;
                break;
            case 'Miercoles':
                $diaSemana = 2;
                break;
            case 'Jueves':
                $diaSemana = 3;
                break;
            case 'Viernes':
                $diaSemana = 4;
                break;
            case 'Sabado':
                $diaSemana = 5;
                break;
            case 'Domingo':
                $diaSemana = 6;
                break;
        }
        $díasAnio = (($semanaAnio-1) * 7) + $diaSemana;
        $primerDiaAnio->add(new \DateInterval('P'.$díasAnio.'D'));
        return $primerDiaAnio;
    }

    private function getStartEndDays($periodo) {

        $now = new \DateTime();
        $nowSemana = \Date('w', $now->getTimestamp()); // 0 Dom
        $startDate = new \DateTime($now->format('Y-m-d'));
        $nowSemana = $nowSemana == 0? 0:$nowSemana - 1;
        $startDate->sub(new \DateInterval('P'.$nowSemana.'D'));
        $endDate = new \DateTime($startDate->format('Y-m-d')); 
        $endDate->add(new \DateInterval('P'.($periodo-1).'D'));

        return array('startDay' => $startDate, 'endDay' => $endDate);
    }
}
