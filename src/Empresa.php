<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\EmpresaRepository")
 */
class Empresa
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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $logo;

    /**
     * @var int
     *
     * @ORM\Column(name="idFM", type="integer")
     */
    private $idFM;

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
     * @return Empresa
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

    public function __toString()
    {
        return $this->getNombre();
    }
}

