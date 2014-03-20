<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personal
 *
 * @ORM\Table(name="personal")
 * @ORM\Entity
 */
class Personal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="personal_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=255, nullable=false)
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="sas", type="string", nullable=true)
     */
    private $sas;

    /**
     * @var \Datos
     *
     * @ORM\ManyToOne(targetEntity="Datos",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="datos_id", referencedColumnName="id")
     * })
     */
    private $datos;

    /**
     * @var \Especialidades
     *
     * @ORM\ManyToOne(targetEntity="Especialidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     * })
     */
    private $especialidad;



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
     * Set procedencia
     *
     * @param string $procedencia
     * @return Personal
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
     * Set tipo
     *
     * @param string $tipo
     * @return Personal
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
     * Set sas
     *
     * @param string $sas
     * @return Personal
     */
    public function setSas($sas)
    {
        $this->sas = $sas;
    
        return $this;
    }

    /**
     * Get sas
     *
     * @return string 
     */
    public function getSas()
    {
        return $this->sas;
    }

    /**
     * Set datos
     *
     * @param \CDI\EnfermeriaBundle\Entity\Datos $datos
     * @return Personal
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
     * Set especialidad
     *
     * @param \CDI\EnfermeriaBundle\Entity\Especialidades $especialidad
     * @return Personal
     */
    public function setEspecialidad(\CDI\EnfermeriaBundle\Entity\Especialidades $especialidad = null)
    {
        $this->especialidad = $especialidad;
    
        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \CDI\EnfermeriaBundle\Entity\Especialidades 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
}