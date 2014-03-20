<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pacientes
 *
 * @ORM\Table(name="pacientes")
 * @ORM\Entity
 */
class Pacientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="pacientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=255, nullable=false)
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=255, nullable=false)
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=255, nullable=false)
     */
    private $referencia;

    /**
     * @var \Datos
     *
     * @ORM\ManyToOne(targetEntity="Datos", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="datos_id", referencedColumnName="id")
     * })
     */
    private $datos;

    /**
     * @var \Pfg
     *
     * @ORM\ManyToOne(targetEntity="Pfg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pfg_id", referencedColumnName="id")
     * })
     */
    private $pfg;



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
     * Set genero
     *
     * @param string $genero
     * @return Pacientes
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Pacientes
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Pacientes
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Pacientes
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     * @return Pacientes
     */
    public function setProcedencia($procedencia)
    {
        $this->procedencia = $procedencia;
    
        return $this;
    }

    /**
     * Get procedencia
     *
     * @return string 
     */
    public function getProcedencia()
    {
        return $this->procedencia;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Pacientes
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    
        return $this;
    }

    /**
     * Get referencia
     *
     * @return string 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set datos
     *
     * @param \CDI\EnfermeriaBundle\Entity\Datos $datos
     * @return Pacientes
     */
    public function setDatos(\CDI\EnfermeriaBundle\Entity\Datos $datos = null)
    {
        $this->datos = $datos;
    
        return $this;
    }

    /**
     * Get datos
     *
     * @return \CDI\EnfermeriaBundle\Entity\Datos 
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set pfg
     *
     * @param \CDI\EnfermeriaBundle\Entity\Pfg $pfg
     * @return Pacientes
     */
    public function setPfg(\CDI\EnfermeriaBundle\Entity\Pfg $pfg = null)
    {
        $this->pfg = $pfg;
    
        return $this;
    }

    /**
     * Get pfg
     *
     * @return \CDI\EnfermeriaBundle\Entity\Pfg 
     */
    public function getPfg()
    {
        return $this->pfg;
    }
    
    public function __toString(){
        return $this->getDatos()->getApellidos().' '.$this->getDatos()->getNombres();
    }
}