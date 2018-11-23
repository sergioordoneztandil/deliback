<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plato
 *
 * @ORM\Table(name="plato")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PlatoRepository")
 */
class Plato
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
     * @var int
     *
     * @ORM\Column(name="idFM", type="integer")
     */
    private $idFM;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default_value", type="boolean")
     */
    private $defaultValue;

    /**
     * @var int
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $imagen;

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
     * @return Plato
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
     * Set idFM
     *
     * @param integer $idFM
     *
     * @return Plato
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
     * Set defaultValue
     *
     * @param boolean $defaultValue
     *
     * @return Plato
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return boolean
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Plato
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set imagen
     *
     * @param \stdClass $imagen
     *
     * @return Empresa
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return \stdClass
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}

