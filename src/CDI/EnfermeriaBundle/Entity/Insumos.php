<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Insumos
 *
 * @ORM\Table(name="insumos")
 * @ORM\Entity
 */
class Insumos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="insumos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\Column(name="disponible", type="integer", nullable=false)
     */
    private $disponible;

    /**
     * @var \TiposInsumo
     *
     * @ORM\ManyToOne(targetEntity="TiposInsumo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_insumo_id", referencedColumnName="id")
     * })
     */
    private $tipoInsumo;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Insumos
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
     * Set stock
     *
     * @param integer $stock
     * @return Insumos
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    
        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set disponible
     *
     * @param integer $disponible
     * @return Insumos
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    
        return $this;
    }

    /**
     * Get disponible
     *
     * @return integer 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set tipoInsumo
     *
     * @param \CDI\EnfermeriaBundle\Entity\TiposInsumo $tipoInsumo
     * @return Insumos
     */
    public function setTipoInsumo(\CDI\EnfermeriaBundle\Entity\TiposInsumo $tipoInsumo = null)
    {
        $this->tipoInsumo = $tipoInsumo;
    
        return $this;
    }

    /**
     * Get tipoInsumo
     *
     * @return \CDI\EnfermeriaBundle\Entity\TiposInsumo 
     */
    public function getTipoInsumo()
    {
        return $this->tipoInsumo;
    }
     public function __toString()
    {
        return $this->getTipoInsumo().' - '.$this->getNombre();
    }
}