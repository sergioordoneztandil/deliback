<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PedidoRepository")
 */
class Pedido
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
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Cliente", cascade={"persist"})
     */
    private $cliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrega", type="date")
     */
    private $fechaEntrega;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\PedidoItem", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="pedido_pedidoitem",
     *      joinColumns={@ORM\JoinColumn(name="pedido_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pedido_item_id", referencedColumnName="id")}
     *      )
     */
    private $items;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPedido", type="datetime")
     */
    private $fechaPedido;


    public function __construct() {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \stdClass $user
     *
     * @return Pedido
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set cliente
     *
     * @param \stdClass $cliente
     *
     * @return Pedido
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return Pedido
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set fechaPedido
     *
     * @param \DateTime $fechaPedido
     *
     * @return Pedido
     */
    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;

        return $this;
    }

    /**
     * Get fechaPedido
     *
     * @return \DateTime
     */
    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    /**
     * Get item
     *
     * @return ArrayCollection
     */
    public function getItems(){
    	return $this->items;
    }
    
    /**
     * Set item
     *
     * @param ArrayCollection $item
     * @return OrdenServicio
     */
    public function setItems($items)
    {
    	$this->items = $items;
    
    	return $this;
    }
    
    /**
     * Add $item
     *
     * @param Item $item
     * @return OrdenServicio
     */
    public function addItem($item)
    {
    	if (!$this->items->contains($item)) {
    		$this->items[] = $item;
    	}
    	return $this;
    }
    
    /**
     *
     */
    public function clearItems()
    {
    	$this->items->clear();
    }
    
    public function removeItem($item)
    {
    	$this->items->removeElement($item);
    }
}

