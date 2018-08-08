<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table(name="at_proje", indexes={@ORM\Index(name="uuid", columns={"uuid"}),@ORM\Index(name="route", columns={"pj_route"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()

 */

class Project{
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
	 * @ORM\Column(name="pj_title", type="string", length=100, nullable=false)
	 *
	 */
	
	protected $title;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="pj_route", type="string", length=70, nullable=false, unique=true)
	 *
	 */
	protected $route;
/**
     * @ORM\Column(name="pj_image", type="string")
     *
     * #@#Assert\NotBlank(message="Please, upload the project image file.")
     * @Assert\File(mimeTypes={ "image/*" })
     */
	
	
    protected $image;
    
    protected $previewfull;
    
    protected $preview;
    
    protected $preview300;

    
    /**
     *
     * @ORM\Column(name="pj_adescr", type="text", nullable=true)
     *
     */
	protected $description;
	
	/**
	 *
	 * @ORM\Column(name="pj_ameta", type="string", length=255, nullable=true)
	 *
	 */
	protected $meta;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
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
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getImage() {
		return $this->image;
	}
	
	public function getPreview() {
		return $this->preview;
	}
	
	public function setPreview($preview) {
		$this->preview = $preview;
		return $this;
	}
	
	public function getPreview300() {
		return $this->preview300;
	}
	
	public function setPreview300($preview) {
		$this->preview300 = $preview;
		return $this;
	}
	public function setImage($image) {
		$this->image = $image;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getRoute() {
		return $this->route;
	}
	public function setRoute($route) {
		$this->route = $route;
		return $this;
	}
	public function getMeta() {
		return $this->meta;
	}
	public function setMeta($meta) {
		$this->meta = $meta;
		return $this;
	}
	public function getPreviewfull() {
		return $this->previewfull;
	}
	public function setPreviewfull($previewfull) {
		$this->previewfull = $previewfull;
		return $this;
	}
	
	
	
}