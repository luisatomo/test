<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="at_apage", indexes={@ORM\Index(name="uuid", columns={"uuid"}), @ORM\Index(name="route", columns={"pg_route"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Page{
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
	 * @ORM\Column(name="pg_route", type="string", length=70, nullable=false, unique=true)
	 *
	 */
	protected $route;
	
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="pg_title", type="text", nullable=false)
	 *
	 */
	protected $title;
	
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="pg_ptitl", type="string", length=100, nullable=true)
	 *
	 */
	protected $pagetitle;
	/**
	 *
	 * @ORM\Column(name="pg_descr", type="string", length=255, nullable=true)
	 *
	 */
	protected $description;
	
	/**
	 *
	 * @ORM\Column(name="pg_ameta", type="string", length=255, nullable=true)
	 *
	 */
	protected $meta;
	
	/**
	 *
	 * @ORM\Column(name="pg_abody", type="text", nullable=true)
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
	public function getPagetitle() {
		return $this->pagetitle;
	}
	public function setPagetitle($pagetitle) {
		$this->pagetitle = $pagetitle;
		return $this;
	}
	
	
	
}