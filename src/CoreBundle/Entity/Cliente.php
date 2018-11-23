<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ClienteRepository")
 */
class Cliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoCuenta", type="string", length=255, nullable=true)
     */
    private $codigoCuenta;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Menu", mappedBy="cliente",cascade={"persist"})
     */
    private $menues;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Seccion", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="cliente_seccion",
     *      joinColumns={@ORM\JoinColumn(name="cliente_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="seccion_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"nombre" = "ASC"})
     */
    private $secciones;

    public function __construct()
    {
        $this->menues = new ArrayCollection();
        $this->secciones = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codigoCuenta
     *
     * @param string $codigoCuenta
     *
     * @return Cliente
     */
    public function setCodigoCuenta($codigoCuenta)
    {
        $this->codigoCuenta = $codigoCuenta;

        return $this;
    }

    /**
     * Get codigoCuenta
     *
     * @return string
     */
    public function getCodigoCuenta()
    {
        return $this->codigoCuenta;
    }

    /**
     * Set logo
     *
     * @param \stdClass $logo
     *
     * @return Empresa
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \stdClass
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get seccion
     *
     * @return ArrayCollection
     */
    public function getSecciones(){
    	return $this->secciones;
    }
    
    /**
     * Set seccion
     *
     * @param ArrayCollection $seccion
     * @return OrdenServicio
     */
    public function setSecciones($secciones)
    {
    	$this->secciones = $secciones;
    
    	return $this;
    }
    
    /**
     * Add $seccion
     *
     * @param Seccion $seccion
     * @return OrdenServicio
     */
    public function addSeccion($seccion)
    {
    	if (!$this->secciones->contains($seccion)) {
    		$this->secciones[] = $seccion;
    	}
    	return $this;
    }
    
    /**
     *
     */
    public function clearSecciones()
    {
    	$this->secciones->clear();
    }
    
    public function removeSeccion($seccion)
    {
    	$this->secciones->removeElement($seccion);
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}

