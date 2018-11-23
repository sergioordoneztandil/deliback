<?php

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_group")
 */
class Group extends BaseGroup
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="perfil", type="integer", nullable=true)
     */
    private $perfil;

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
     * Set perfil
     *
     * @return User
     */
    public function setPerfil($perfil)
    {
    	$this->perfil = $perfil;
    
    	return $this;
    }
    
    /**
     * Get perfil
     *
     */
    public function getPerfil()
    {
    	return $this->perfil;
    }
}