<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="cb_autor")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Autor{
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
	 * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
	 *
	 */
	
	protected $nombre;

	/*
	*  @ORM\ManyToMany(targetEntity="Libro", mappedBy="autores")
    * @ORM\JoinTable(
     *  name="autor_libro",
     *  joinColumns={
     *      @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="libro_id", referencedColumnName="id")
     *  }     * @Assert\Count(min="1")
	 */

	protected $libros;
	
	
	public function getId() {
		return $this->id;
	}

	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
		return $this;
	}

	public function __toString(){
		return $this->nombre;
	}
	
	
	
}