<?php

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Cliente", cascade={"persist"})
     */
    private $cliente;

    /**
    * @ORM\Column(type="integer")
    */
    protected $type;
    
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set cliente
     *
     * @return User
     */
    public function setCliente($cliente)
    {
    	$this->cliente = $cliente;
    
    	return $this;
    }

    /**
     * Get cliente
     *
     */
    public function getCliente()
    {
    	return $this->cliente;
    }

    /**
     * Set type
     *
     * @return User
     */
    public function setType($type)
    {
    	$this->type = $type;
    
    	return $this;
    }

    /**
     * Get type
     *
     */
    public function getType()
    {
    	return $this->type;
    }
    
    
}