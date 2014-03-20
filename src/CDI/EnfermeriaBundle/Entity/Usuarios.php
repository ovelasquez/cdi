<?php

namespace CDI\EnfermeriaBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CDI\EnfermeriaBundle\Entity\UsuariosRepository")
 */
class Usuarios  implements AdvancedUserInterface, \Serializable
{
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

   /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

     /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    private $groups;
    
    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="string", length=255, nullable=false)
     */
    private $respuesta;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pregunta", type="string", length=255, nullable=false)
     */
    private $pregunta;
    
    /**
     * @var \Datos
     *
     * @ORM\ManyToOne(targetEntity="Datos", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="datos_id", referencedColumnName="id")
     * })
     */
    private $datos;
    
    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
     public function getRoles()
    {
        return $this->groups->toArray();
    }
    
    /**
     * Set respuesta
     *
     * @param string $respuesta
     * @return Usuarios
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set pregunta
     *
     * @param string $pregunta
     * @return Usuarios
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return string 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }
    
    
    /**
     * Set datos
     *
     * @param \CDI\EnfermeriaBundle\Entity\Datos $datos
     * @return Usuarios
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
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        return $this->id === $user->getId();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

   public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

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
     * Set username
     *
     * @param string $username
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuarios
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuarios
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add groups
     *
     * @param \CDI\EnfermeriaBundle\Entity\Group $groups
     * @return Usuarios
     */
    public function addGroup(\CDI\EnfermeriaBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }

    /**
     * Remove groups
     *
     * @param \CDI\EnfermeriaBundle\Entity\Group $groups
     */
    public function removeGroup(\CDI\EnfermeriaBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    
    public function __toString() {
        return $this->getDatos()->getApellidos()." ".$this->getDatos()->getNombres();
    }
}
