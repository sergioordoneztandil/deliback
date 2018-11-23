<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoItem
 *
 * @ORM\Table(name="pedido_item")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PedidoItemRepository")
 */
class PedidoItem
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
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Menu", cascade={"persist"})
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Plato", cascade={"persist"})
     */
    private $plato;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Empleado", cascade={"persist"})
     */
    private $empleado;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Seccion", cascade={"persist"})
     */
    private $seccion;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dia", type="date")
     */
    private $dia;


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
     * Set menu
     *
     * @param \stdClass $menu
     *
     * @return PedidoItem
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \stdClass
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set plato
     *
     * @param \stdClass $plato
     *
     * @return PedidoItem
     */
    public function setPlato($plato)
    {
        $this->plato = $plato;

        return $this;
    }

    /**
     * Get plato
     *
     * @return \stdClass
     */
    public function getPlato()
    {
        return $this->plato;
    }

    /**
     * Set empleado
     *
     * @param \stdClass $empleado
     *
     * @return PedidoItem
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \stdClass
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set seccion
     *
     * @param \stdClass $seccion
     *
     * @return PedidoItem
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return \stdClass
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return PedidoItem
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set dia
     *
     * @param \DateTime $dia
     *
     * @return PedidoItem
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
}

