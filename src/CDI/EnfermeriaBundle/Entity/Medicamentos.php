<?php

namespace CDI\EnfermeriaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamentos
 *
 * @ORM\Table(name="medicamentos")
 * @ORM\Entity
 */
class Medicamentos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="medicamentos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="principio_activo", type="string", length=255, nullable=false)
     */
    private $principioActivo;

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
     * @var \TiposMedicamento
     *
     * @ORM\ManyToOne(targetEntity="TiposMedicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_medicamento_id", referencedColumnName="id")
     * })
     */
    private $tipoMedicamento;



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
     * Set principioActivo
     *
     * @param string $principioActivo
     * @return Medicamentos
     */
    public function setPrincipioActivo($principioActivo)
    {
        $this->principioActivo = $principioActivo;
    
        return $this;
    }

    /**
     * Get principioActivo
     *
     * @return string 
     */
    public function getPrincipioActivo()
    {
        return $this->principioActivo;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Medicamentos
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
     * @return Medicamentos
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
     * Set tipoMedicamento
     *
     * @param \CDI\EnfermeriaBundle\Entity\TiposMedicamento $tipoMedicamento
     * @return Medicamentos
     */
    public function setTipoMedicamento(\CDI\EnfermeriaBundle\Entity\TiposMedicamento $tipoMedicamento = null)
    {
        $this->tipoMedicamento = $tipoMedicamento;
    
        return $this;
    }

    /**
     * Get tipoMedicamento
     *
     * @return \CDI\EnfermeriaBundle\Entity\TiposMedicamento 
     */
    public function getTipoMedicamento()
    {
        return $this->tipoMedicamento;
    }
    
    public function __toString(){
        return $this->getPrincipioActivo().' - '.$this->getTipoMedicamento();
    }
}