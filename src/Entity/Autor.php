<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="cb_libro")
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