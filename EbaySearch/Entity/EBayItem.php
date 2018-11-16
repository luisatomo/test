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

class EBayItem{
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
	 * @ORM\Column(name="itemid", type="string", nullable=false)
	 *
	 */
	protected $itemid;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="title", type="string", length=255, nullable=false)
	 *
	 */
	protected $title;
	/**
	 * @Assert\NotBlank()
	 *
	 * @ORM\Column(name="seller", type="string", length=255, nullable=true)
	 *
	 */
	protected $seller;
	
	/**	 *
	 * @ORM\Column(name="imageurl", type="string", length=255, nullable=true)
	 *
	 */
	protected $image;
	
	/**	 *
	 * @ORM\Column(name="price", type="string", length=100, nullable=true)
	 *
	 */
	protected $price;
	
	public function getId() {
		return $this->id;
	}
	public function getItemid() {
		return $this->itemid;
	}
	public function setItemid($itemid) {
		$this->itemid = $itemid;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getSeller() {
		return $this->seller;
	}
	public function setSeller($seller) {
		$this->seller = $seller;
		return $this;
	}
	public function getImage() {
		return $this->image;
	}
	public function setImage($image) {
		$this->image = $image;
		return $this;
	}
	public function getPrice() {
		return $this->price;
	}
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}
	
	
	
}