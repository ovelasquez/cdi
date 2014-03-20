<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObservacionesSuministradas
 *
 * @ORM\Table(name="observaciones_suministradas")
 * @ORM\Entity
 */
class ObservacionesSuministradas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="observaciones_suministradas_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ObservacionesSuministradas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return ObservacionesSuministradas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ObservacionesSuministradas
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
     * @return ObservacionesSuministradas
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
     * @return ObservacionesSuministradas
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
}