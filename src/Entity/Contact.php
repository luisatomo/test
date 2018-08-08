<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="at_conta", indexes={@ORM\Index(name="uuid", columns={"uuid"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Contact{
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
	 * @ORM\Column(name="uuid", type="guid", length=36)
	 */
	
	protected $uuid;
	
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="co_fname", type="string", length=200, nullable=false)
	 *
	 */
	protected $fullname;
	
	/**
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message = "The email '{{ value }}' is not a valid email.",
	 *     checkMX = true,
	 *     strict = true
	 * )
	 *
	 * @ORM\Column(name="co_email", type="string", length=255, nullable=false)
	 *
	 */
	protected $email;
	
	/**
	 *
	 * @ORM\Column(name="co_abody", type="text", nullable=true)
	 *
	 */
	protected $body;
	
	/**
	 *
	 * @ORM\Column(name="cdate", type="datetime", nullable=false)
	 */
	protected $cdate;
	
	/**
	 *
	 * @ORM\Column(name="mdate", type="datetime", nullable=false)
	 */
	protected $mdate;
	
	public function getId() {
		return $this->id;
	}
	
	public function getUuid(){
		return $this->uuid;
	}
	
	/**
	 * @ORM\PrePersist
	 */
	
	public function setUuid(){
		$s = md5(uniqid(rand(),true));
		$uuid = substr($s,0,8) . '-' .
				substr($s,8,4) . '-' .
				substr($s,12,4). '-' .
				substr($s,16,4). '-' .
				substr($s,20);
				$this->uuid=$uuid;
	}
	
	
	public function getMdate() {
		return $this->mdate;
	}
	public function setMdate($mdate) {
		$this->mdate = $mdate;
		return $this;
	}
	
	/**
	 * @ORM\PrePersist
	 * @ORM\PreUpdate
	 */
	public function updateTimestamps()
	{
		$this->setMdate(new \DateTime(date('Y-m-d H:i:s')));
	
		if($this->getCdate() == null)
		{
			$this->setCdate(new \DateTime(date('Y-m-d H:i:s')));
		}
	}
	public function getFullname() {
		return $this->fullname;
	}
	public function setFullname($fullname) {
		$this->fullname = $fullname;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getBody() {
		return $this->body;
	}
	public function setBody($body) {
		$this->body = $body;
		return $this;
	}
	public function getCdate() {
		return $this->cdate;
	}
	public function setCdate($cdate) {
		$this->cdate = $cdate;
		return $this;
	}
	

	
	
	
}