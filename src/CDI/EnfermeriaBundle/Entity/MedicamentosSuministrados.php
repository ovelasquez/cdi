<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedicamentosSuministrados
 *
 * @ORM\Table(name="medicamentos_suministrados")
 * @ORM\Entity
 */
class MedicamentosSuministrados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="medicamentos_suministrados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="via_administracion", type="string", length=255, nullable=false)
     */
    private $viaAdministracion;

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
     * @var \Medicamentos
     *
     * @ORM\ManyToOne(targetEntity="Medicamentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medicamento_id", referencedColumnName="id")
     * })
     */
    private $medicamento;



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
     * @return MedicamentosSuministrados
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
     * Set viaAdministracion
     *
     * @param string $viaAdministracion
     * @return MedicamentosSuministrados
     */
    public function setViaAdministracion($viaAdministracion)
    {
        $this->viaAdministracion = $viaAdministracion;
    
        return $this;
    }

    /**
     * Get viaAdministracion
     *
     * @return string 
     */
    public function getViaAdministracion()
    {
        return $this->viaAdministracion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return MedicamentosSuministrados
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
     * @return MedicamentosSuministrados
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
     * @return MedicamentosSuministrados
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
     * Set medicamento
     *
     * @param \CDI\EnfermeriaBundle\Entity\Medicamentos $medicamento
     * @return MedicamentosSuministrados
     */
    public function setMedicamento(\CDI\EnfermeriaBundle\Entity\Medicamentos $medicamento = null)
    {
        $this->medicamento = $medicamento;
    
        return $this;
    }

    /**
     * Get medicamento
     *
     * @return \CDI\EnfermeriaBundle\Entity\Medicamentos 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }
}