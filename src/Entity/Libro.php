<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 * @ORM\Table(name="cb_libro")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Libro{
	/**
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 *
	 */
	protected $id;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
	 *
	 */
	
	protected $titulo;
	/**	 *
	 * @ORM\Column(name="fecha", type="date", nullable=true)
	 *
	 */
	protected $fecha;

	/*
	*  @ORM\ManyToMany(targetEntity="Autor")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id",inversedBy="libros")
     * @Assert\Count(min="1")
	 */

	protected $autores;

	
	
	
	public function getId() {
		return $this->id;
	}

	public function getTitulo() {
		return $this->titulo;
	}
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
		return $this;
	}
	public function getFecha() {
		return $this->fecha;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
		return $this;
	}

	public function __toString(){
		return $this->titulo;
	}

	public function __construct(){
		$this->autores=new ArrayCollection();
	}

	public function getAutores()
    {
        return $this->autores;
	}

	public function setAutores($autores)
    {
		$this->autores=$autores;
		return $this;
	}
	
	public function getAutoresCount(){
		return count($this->autores);
	}
	
	
	
}