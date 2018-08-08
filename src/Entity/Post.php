<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="at_apost", indexes={@ORM\Index(name="uuid", columns={"uuid"}), @ORM\Index(name="route", columns={"pt_route"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Post{
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
	 * @ORM\Column(name="pt_route", type="string", length=70, nullable=false, unique=true)
	 *
	 */
	protected $route;
	
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="pt_title", type="string", length=100, nullable=false)
	 *
	 */
	protected $title;
	/**
	 *
	 * @ORM\Column(name="pt_descr", type="string", length=255, nullable=true)
	 *
	 */
	protected $description;
	
	/**
	 *
	 * @ORM\Column(name="pt_ameta", type="string", length=255, nullable=true)
	 *
	 */
	protected $meta;
	
	/**
	 *
	 * @ORM\Column(name="pt_abody", type="text", nullable=true)
	 *
	 */
	protected $body;
	
	/**
	 *
	 * @ORM\Column(name="pt_publi", type="boolean", nullable=true)
	 *
	 */
	protected $published;
	
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
	
	public function getRoute(){
		return $this->route;
	}
	
	public function setRoute($route){
		$this->route=$route;
		return $this;
	}

	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getMeta() {
		return $this->meta;
	}
	public function setMeta($meta) {
		$this->meta = $meta;
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
	public function getPublished() {
		return $this->published;
	}
	public function setPublished($published) {
		$this->published = $published;
		return $this;
	}
	
	
	
}