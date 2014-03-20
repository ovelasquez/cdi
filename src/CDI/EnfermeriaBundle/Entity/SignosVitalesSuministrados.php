<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SignosVitalesSuministrados
 *
 * @ORM\Table(name="signos_vitales_suministrados")
 * @ORM\Entity
 */
class SignosVitalesSuministrados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="signos_vitales_suministrados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

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
     * Set valor
     *
     * @param string $valor
     * @return SignosVitalesSuministrados
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SignosVitalesSuministrados
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return SignosVitalesSuministrados
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
     * @return SignosVitalesSuministrados
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
     * @return SignosVitalesSuministrados
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