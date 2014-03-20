<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsumosSuministrados
 *
 * @ORM\Table(name="insumos_suministrados")
 * @ORM\Entity
 */
class InsumosSuministrados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="insumos_suministrados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var \Consultas
     *
     * @ORM\ManyToOne(targetEntity="Consultas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id", referencedColumnName="id")
     * })
     */
    private $consulta;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Insumos
     *
     * @ORM\ManyToOne(targetEntity="Insumos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="insumo_id", referencedColumnName="id")
     * })
     */
    private $insumo;



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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return InsumosSuministrados
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return InsumosSuministrados
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set consulta
     *
     * @param \CDI\EnfermeriaBundle\Entity\Consultas $consulta
     * @return InsumosSuministrados
     */
    public function setConsulta(\CDI\EnfermeriaBundle\Entity\Consultas $consulta = null)
    {
        $this->consulta = $consulta;
    
        return $this;
    }

    /**
     * Get consulta
     *
     * @return \CDI\EnfermeriaBundle\Entity\Consultas 
     */
    public function getConsulta()
    {
        return $this->consulta;
    }

    /**
     * Set usuario
     *
     * @param \CDI\EnfermeriaBundle\Entity\Usuarios $usuario
     * @return InsumosSuministrados
     */
    public function setUsuario(\CDI\EnfermeriaBundle\Entity\Usuarios $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \CDI\EnfermeriaBundle\Entity\Usuarios 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set insumo
     *
     * @param \CDI\EnfermeriaBundle\Entity\Insumos $insumo
     * @return InsumosSuministrados
     */
    public function setInsumo(\CDI\EnfermeriaBundle\Entity\Insumos $insumo = null)
    {
        $this->insumo = $insumo;
    
        return $this;
    }

    /**
     * Get insumo
     *
     * @return \CDI\EnfermeriaBundle\Entity\Insumos 
     */
    public function getInsumo()
    {
        return $this->insumo;
    }
}