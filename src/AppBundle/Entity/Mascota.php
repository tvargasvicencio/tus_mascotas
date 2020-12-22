<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mascota
 *
 * @ORM\Table(name="mascota")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MascotaRepository")
 */
class Mascota
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="chip", type="integer", unique=true)
     */
    private $chip;

    /**
     * @var int
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=true)
     */
    private $apellido;

    /**
     * @var int
     *
     * @ORM\Column(name="sexo", type="integer")
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50)
     */
    private $color;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="datetime")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="raza", type="string", length=100)
     */
    private $raza;

    /**
     * @var bool
     *
     * @ORM\Column(name="esterilizada", type="boolean")
     */
    private $esterilizada;

    /**
     * @var string
     *
     * @ORM\Column(name="humano_responsable", type="string", length=100)
     */
    private $humanoResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Humano")
     * @ORM\JoinColumn(name="humano_id", referencedColumnName="id")
     */
    private $humanoId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chip
     *
     * @param integer $chip
     *
     * @return Mascota
     */
    public function setChip($chip)
    {
        $this->chip = $chip;

        return $this;
    }

    /**
     * Get chip
     *
     * @return int
     */
    public function getChip()
    {
        return $this->chip;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Mascota
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Mascota
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Mascota
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return Mascota
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return int
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Mascota
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Mascota
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
     * Set raza
     *
     * @param string $raza
     *
     * @return Mascota
     */
    public function setRaza($raza)
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get raza
     *
     * @return string
     */
    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Set esterilizada
     *
     * @param boolean $esterilizada
     *
     * @return Mascota
     */
    public function setEsterilizada($esterilizada)
    {
        $this->esterilizada = $esterilizada;

        return $this;
    }

    /**
     * Get esterilizada
     *
     * @return bool
     */
    public function getEsterilizada()
    {
        return $this->esterilizada;
    }

    /**
     * Set humanoResponsable
     *
     * @param string $humanoResponsable
     *
     * @return Mascota
     */
    public function setHumanoResponsable($humanoResponsable)
    {
        $this->humanoResponsable = $humanoResponsable;

        return $this;
    }

    /**
     * Get humanoResponsable
     *
     * @return string
     */
    public function getHumanoResponsable()
    {
        return $this->humanoResponsable;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Mascota
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set humanoId
     *
     * @param integer $humanoId
     *
     * @return Mascota
     */
    public function setHumanoId($humanoId)
    {
        $this->humanoId = $humanoId;

        return $this;
    }

    /**
     * Get humanoId
     *
     * @return int
     */
    public function getHumanoId()
    {
        return $this->humanoId;
    }
}

