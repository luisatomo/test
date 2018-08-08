<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="at_ainfo")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Info{
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
	 * @ORM\Column(name="in_title", type="string", length=100, nullable=false)
	 *
	 */
	protected $webtitle;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="in_autho", type="string", length=100, nullable=false)
	 *
	 */
	protected $author;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="in_audes", type="string", length=255, nullable=false)
	 *
	 */
	protected $authordesc;
	
	/**
	 * @Assert\NotBlank()
	 *
	 * @Assert\Email(
	 *     message = "The email '{{ value }}' is not a valid email.",
	 *     checkMX = true,
	 *     strict = true
	 * )
	 * 
	 * @ORM\Column(name="in_email", type="string", length=255, nullable=false)
	 */
	protected $email;
	
	public function getId() {
		return $this->id;
	}
	public function getWebtitle() {
		return $this->webtitle;
	}
	public function setWebtitle($webtitle) {
		$this->webtitle = $webtitle;
		return $this;
	}
	public function getAuthor() {
		return $this->author;
	}
	public function setAuthor($author) {
		$this->author = $author;
		return $this;
	}
	public function getAuthordesc() {
		return $this->authordesc;
	}
	public function setAuthordesc($authordesc) {
		$this->authordesc = $authordesc;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	
}