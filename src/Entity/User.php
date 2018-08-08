<?php 
namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="at_auser", indexes={@ORM\Index(name="uuid", columns={"uuid"})})
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     *
     * @ORM\Column(name="uuid", type="guid", length=36)
     */
    
    protected $uuid;

    /**
	 * @Assert\NotBlank()
	 *
	 * @Assert\Email(
	 *     message = "The email '{{ value }}' is not a valid email.",
	 *     checkMX = true,
	 *     strict = true
	 * )
	 * 
	 * @ORM\Column(name="username", type="string", length=255, nullable=false)
	 */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true, length=255, nullable=true)
     */
    private $apiKey;
    
    /**
     * The encoded password
     *
     * @ORM\Column(type="string")
     */
    private $password;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstpassword", type="string", length=12, nullable=true)
     *
     */
    protected $firstpassword;
    
    /**
     * @Assert\Regex(
     *  pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&+=*-~<>?,.\x5b\x5d\x7b\x7c\x7d\x22\x2f\x5c]).{8,}/",
     *  message="Password must be at least 8 characters long and contain at least one digit, one special character, one uppercase and one lowercase character."
     * )
     */
    protected $plainPassword;
    
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
    
    /**
     *
     * @ORM\Column(name="passchanged", type="datetime", nullable=true)
     */
    protected $passchanged;
    
    /**
     *
     * @ORM\Column(name="faildate", type="datetime", nullable=true)
     */
    protected $faildate;
    /**
     *
     * @ORM\Column(name="failcount", type="integer", nullable=true)
     *
     */
    protected $failcount=0;
    /**
     * @ORM\Column(name="ipfail", type="string",length=100, nullable=true)
     */
    protected $ipfail;
    /**
     *
     * @ORM\Column(name="blocked", type="boolean", nullable=true)
     *
     */
    protected $blocked=false;
    /**
     *
     * @ORM\Column(name="blockdate", type="datetime", nullable=true)
     */
    protected $blockdate;
    
    /**
     * @ORM\Column(type="json_array")
     */
    protected $roles = [];
    
    
    
    
    /**
     * @var boolean
     */
    
    /**
     *
     * @ORM\Column(name="locked", type="boolean", nullable=true)
     *
     */
    protected $locked;
    
    /**
     * Date/Time of the last activity
     *
     * @var \Datetime
     * @ORM\Column(name="last_activity_at", type="datetime", nullable=true)
     */
    protected $lastActivityAt;
    
    protected $active;
    
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

    public function getUsername()
    {
        return $this->username;
    }

public function getRoles()
    {
        $roles = $this->roles;
        // give everyone ROLE_USER!
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
}

public function setRoles(array $roles)
{
	$this->roles = $roles;
}

    public function getPassword()
    {
    	return $this->password;
    }
    public function getSalt()
    {
    	return null;
    }
    public function eraseCredentials()
    {
    	$this->plainPassword = null;
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
    public function getFaildate() {
    	return $this->faildate;
    }
    public function setFaildate($faildate) {
    	$this->faildate = $faildate;
    	return $this;
    }
    public function getFailcount() {
    	return $this->failcount;
    }
    public function setFailcount($failcount) {
    	$this->failcount = $failcount;
    	return $this;
    }
    public function getIpfail() {
    	return $this->ipfail;
    }
    public function setIpfail($ipfail) {
    	$this->ipfail = $ipfail;
    	return $this;
    }
    public function getBlocked() {
    	return $this->blocked;
    }
    public function setBlocked($blocked) {
    	$this->blocked = $blocked;
    	return $this;
    }
    public function getBlockdate() {
    	return $this->blockdate;
    }
    public function setBlockdate($blockdate) {
    	$this->blockdate = $blockdate;
    	return $this;
    }
    public function getPasschanged() {
    	return $this->passchanged;
    }
    public function setPasschanged($passchanged) {
    	$this->passchanged = $passchanged;
    	return $this;
    }
   
    
    
    public function isAccountNonLocked()
    {
    	return !$this->locked;
    }
    
    /**
     * @return bool
     */
    public function isLocked()
    {
    	return !$this->isAccountNonLocked();
    }
    
    public function setLocked($boolean)
    {
    	$this->locked = $boolean;
    
    	return $this;
    }
    
    
    
    /**
     * @param \Datetime $lastActivityAt
     */
    public function setLastActivityAt($lastActivityAt)
    {
    	$this->lastActivityAt = $lastActivityAt;
    }
    
    /**
     * @return \Datetime
     */
    public function getLastActivityAt()
    {
    	return $this->lastActivityAt;
    }
    
    public function getActive(){
    	$this->active=$this->isActiveNow();
    	return $this->active;
    }
    
    public function setActive($active){
    
    }
    
    /**
     * @return Bool Whether the user is active or not
     */
    public function isActiveNow()
    {
    	// Delay during wich the user will be considered as still active
    	$delay = new \DateTime('5 minutes ago');
    
    	return ( $this->getLastActivityAt() >= $delay );
    }
	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}
	public function getApiKey() {
		return $this->apiKey;
	}
	public function setApiKey($apiKey) {
		$this->apiKey = $apiKey;
		return $this;
	}
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	public function getFirstpassword() {
		return $this->firstpassword;
	}
	public function setFirstpassword($firstpassword) {
		$this->firstpassword = $firstpassword;
		return $this;
	}
	public function getPlainPassword() {
		return $this->plainPassword;
	}
	public function setPlainPassword($plainPassword) {
		$this->plainPassword = $plainPassword;

		$this->password = null;
		return $this;
	}
	public function getLocked() {
		return $this->locked;
	}
	public function getId() {
		return $this->id;
	}
	public function getUuid() {
		return $this->uuid;
	}
	
	

    // more getters/setters
}