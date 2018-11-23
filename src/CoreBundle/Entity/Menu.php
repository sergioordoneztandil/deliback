<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\MenuRepository")
 */
class Menu
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
     * @var int
     *
     * @ORM\Column(name="idFM", type="integer")
     */
    private $idFM;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Cliente", inversedBy="menues",cascade={"persist"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dia", type="date", nullable=true)
     */
    private $dia;

    /**
     * @var int
     *
     * @ORM\Column(name="semanaNro", type="integer")
     */
    private $semanaNro;

    /**
     * @var int
     *
     * @ORM\Column(name="semanaNroAnio", type="integer")
     */
    private $semanaNroAnio;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="altaFecha", type="date", nullable=true)
     */
    private $altaFecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modificacionFecha", type="date", nullable=true)
     */
    private $modificacionFecha;

    /**
     * @var string
     *
     * @ORM\Column(name="altaUsuario", type="string", length=255, nullable=true)
     */
    private $altaUsuario;


    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Plato", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="menu_plato",
     *      joinColumns={@ORM\JoinColumn(name="menu_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="plato_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"tipo" = "ASC", "defaultValue" = "DESC"})
     */
    private $platos;

    public function __construct() {
        $this->platos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idFM
     *
     * @param integer $idFM
     *
     * @return Menu
     */
    public function setIdFM($idFM)
    {
        $this->idFM = $idFM;

        return $this;
    }

    /**
     * Get idFM
     *
     * @return int
     */
    public function getIdFM()
    {
        return $this->idFM;
    }

    /**
     * Set cliente
     *
     * @param \stdClass $cliente
     *
     * @return Menu
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \stdClass
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Menu
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
     * Set dia
     *
     * @param \DateTime $dia
     *
     * @return Menu
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return \DateTime
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set semanaNro
     *
     * @param integer $semanaNro
     *
     * @return Menu
     */
    public function setSemanaNro($semanaNro)
    {
        $this->semanaNro = $semanaNro;

        return $this;
    }

    /**
     * Get semanaNro
     *
     * @return int
     */
    public function getSemanaNro()
    {
        return $this->semanaNro;
    }

    /**
     * Set semanaNroAnio
     *
     * @param integer $semanaNroAnio
     *
     * @return Menu
     */
    public function setSemanaNroAnio($semanaNroAnio)
    {
        $this->semanaNroAnio = $semanaNroAnio;

        return $this;
    }

    /**
     * Get semanaNroAnio
     *
     * @return int
     */
    public function getSemanaNroAnio()
    {
        return $this->semanaNroAnio;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Menu
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set altaFecha
     *
     * @param \DateTime $altaFecha
     *
     * @return Menu
     */
    public function setAltaFecha($altaFecha)
    {
        $this->altaFecha = $altaFecha;

        return $this;
    }

    /**
     * Get altaFecha
     *
     * @return \DateTime
     */
    public function getAltaFecha()
    {
        return $this->altaFecha;
    }

    /**
     * Set modificacionFecha
     *
     * @param \DateTime $modificacionFecha
     *
     * @return Menu
     */
    public function setModificacionFecha($modificacionFecha)
    {
        $this->modificacionFecha = $modificacionFecha;

        return $this;
    }

    /**
     * Get modificacionFecha
     *
     * @return \DateTime
     */
    public function getModificacionFecha()
    {
        return $this->modificacionFecha;
    }

    /**
     * Set altaUsuario
     *
     * @param string $altaUsuario
     *
     * @return Menu
     */
    public function setAltaUsuario($altaUsuario)
    {
        $this->altaUsuario = $altaUsuario;

        return $this;
    }

    /**
     * Get altaUsuario
     *
     * @return string
     */
    public function getAltaUsuario()
    {
        return $this->altaUsuario;
    }

    /**
     * Get plato
     *
     * @return ArrayCollection
     */
    public function getPlatos(){
    	return $this->platos;
    }
    
    /**
     * Set plato
     *
     * @param ArrayCollection $plato
     * @return OrdenServicio
     */
    public function setPlatos($platos)
    {
    	$this->platos = $platos;
    
    	return $this;
    }
    
    /**
     * Add $plato
     *
     * @param Plato $plato
     * @return OrdenServicio
     */
    public function addPlato($plato)
    {
    	if (!$this->platos->contains($plato)) {
    		$this->platos[] = $plato;
    	}
    	return $this;
    }
    
    /**
     *
     */
    public function clearPlatos()
    {
    	$this->platos->clear();
    }
    
    public function removePlato($plato)
    {
    	$this->platos->removeElement($plato);
    }

    public function __toString()
    {
        return ''.$this->getNombre();
    }
}

