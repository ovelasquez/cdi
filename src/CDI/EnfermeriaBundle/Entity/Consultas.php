<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultas
 *
 * @ORM\Table(name="consultas")
 * @ORM\Entity
 *
 */
class Consultas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="consultas_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="charla", type="boolean", nullable=true)
     */
    private $charla;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egreso", type="boolean", nullable=true)
     */
    private $egreso;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuarios_id", referencedColumnName="id")
     * })
     */
    private $usuarios;

    /**
     * @var \Pacientes
     *
     * @ORM\ManyToOne(targetEntity="Pacientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;


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
     * Set charla
     *
     * @param boolean $charla
     * @return Consultas
     */
    public function setCharla($charla)
    {
        $this->charla = $charla;
    
        return $this;
    }

    /**
     * Get charla
     *
     * @return boolean 
     */
    public function getCharla()
    {
        return $this->charla;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Consultas
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
     * Set egreso
     *
     * @param boolean $egreso
     * @return Consultas
     */
    public function setEgreso($egreso)
    {
        $this->egreso = $egreso;
    
        return $this;
    }

    /**
     * Get egreso
     *
     * @return boolean 
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set usuarios
     *
     * @param \CDI\EnfermeriaBundle\Entity\Usuarios $usuarios
     * @return Consultas
     */
    public function setUsuarios(\CDI\EnfermeriaBundle\Entity\Usuarios $usuarios = null)
    {
        $this->usuarios = $usuarios;
    
        return $this;
    }

    /**
     * Get usuarios
     *
     * @return \CDI\EnfermeriaBundle\Entity\Usuarios 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set paciente
     *
     * @param \CDI\EnfermeriaBundle\Entity\Pacientes $paciente
     * @return Consultas
     */
    public function setPaciente(\CDI\EnfermeriaBundle\Entity\Pacientes $paciente = null)
    {
        $this->paciente = $paciente;
    
        return $this;
    }

    /**
     * Get paciente
     *
     * @return \CDI\EnfermeriaBundle\Entity\Pacientes 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }
    
    public function __toString(){
          return $this->getPaciente()->getDatos()->getApellidos().' '.$this->getPaciente()->getDatos()->getNombres().' '.$this->getPaciente()->getDatos()->getCedula().' '.$this->getId();
    }
}