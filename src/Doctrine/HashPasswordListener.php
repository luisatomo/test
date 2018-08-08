<?php
namespace App\Doctrine;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

class HashPasswordListener implements EventSubscriber
{
	private $passwordEncoder;
	public function __construct(UserPasswordEncoderInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}
	
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
    	$entity = $args->getEntity();
    	if (!$entity instanceof User) {
    		return;
    	}
    	
    	$this->encodePassword($entity);
    }
    
    public function preUpdate(LifecycleEventArgs $args)
    {
    	$entity = $args->getEntity();
    	if (!$entity instanceof User) {
    		return;
    	}
    	$this->encodePassword($entity);
    	// necessary to force the update to see the change
    	$em = $args->getEntityManager();
    	$meta = $em->getClassMetadata(get_class($entity));
    	$em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }
    
    private function encodePassword(User $entity)
    {
    	if (!$entity->getPlainPassword()) {
    		return;
    	}
    	$encoded = $this->passwordEncoder->encodePassword(
    			$entity,
    			$entity->getPlainPassword()
    			);
    	$entity->setPassword($encoded);
    }
    
}