<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="cb_autorlibro")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class AutorLibro{
	/**
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 *
	 */
	protected $id;
	/**
     *
     * @ORM\ManyToOne(targetEntity="Autor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="autor", referencedColumnName="id")
     * })
     */
    protected $autor;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Libro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="libro", referencedColumnName="id")
     * })
     */
    protected $libro;
	
	
	public function getId() {
		return $this->id;
	}

	public function getAutor() {
		return $this->autor;
	}
	public function setAutor($autor) {
		$this->autor = $autor;
		return $this;
	}
	public function getLibro() {
		return $this->libro;
	}
	public function setCourse($libro) {
		$this->libro = $libro;
		return $this;
	}
	
	
	
}