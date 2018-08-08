<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Project;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class ProjectUploadListener
{
	private $uploader;

	public function __construct(FileUploader $uploader)
	{
		$this->uploader = $uploader;
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();

		$this->uploadFile($entity);
	}

	public function preUpdate(PreUpdateEventArgs $args)
	{
		$entity = $args->getEntity();
		
		// This logic only works for Product entities
		if (!$entity instanceof Project) {
			return;
		}
		
		// Check which fields were changes
		$changes = $args->getEntityChangeSet();
		
		// Declare a variable that will contain the name of the previous file, if exists.
		$previousFilename = null;
		
		// Verify if the brochure field was changed
		if(array_key_exists("image", $changes)){
			// Update previous file name
			$previousFilename = $changes["image"][0];
		}
		
		// If no new brochure file was uploaded
		if(is_null($entity->getImage())){
			// Let original filename in the entity
			$entity->setImage($previousFilename);
		
			// If a new brochure was uploaded in the form
		}else{
			// If some previous file exist
			if(!is_null($previousFilename)){
				$pathPreviousFile = $this->uploader->getTargetDir(). "/". $previousFilename;
		
				// Remove it
				if(file_exists($pathPreviousFile)){
					unlink($pathPreviousFile);
				}
			}

		$this->uploadFile($entity);
		}
	}

	private function uploadFile($entity)
	{
		// upload only works for Product entities
		if (!$entity instanceof Project) {
			return;
		}

		$file = $entity->getImage();

		// only upload new files
		if ($file instanceof UploadedFile) {
			$fileName = $this->uploader->upload($file);
			$entity->setImage($fileName);
		}
	}
	
	public function postLoad(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
	
		if (!$entity instanceof Project) {
			return;
		}
	
		if ($fileName = $entity->getImage()) {
			$img=$this->uploader->getTargetDirectory().'/'.$fileName;
			$entity->setPreviewfull($entity->getImage());
			$preview=$this->generateThumbnail($img, 100, 100);
			$preview300=$this->generateThumbnail($img, 400, 300);
			$entity->setPreview('/uploads/projects/'.$preview);
			$entity->setPreview300('/uploads/projects/'.$preview300);
			//$entity->setImage(new File($img));
		}
	}
	
	private function generateThumbnail($img, $width, $height, $quality = 90)
{
		$explode=explode('.', $img);
	$filename_no_ext = reset($explode);
	$filex=$filename_no_ext.'_'.$width.'x'.$height.'.jpg';
	if(is_file($filex))
		return basename($filex);
    if (is_file($img)) {
        $imagick = new \Imagick(realpath($img));
        $imagick->setImageFormat('jpeg');
        $imagick->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $imagick->setImageCompressionQuality($quality);
        $imagick->thumbnailImage($width, $height, false, false);
        
        if (file_put_contents($filename_no_ext .'_'.$width.'x'.$height.'.jpg', $imagick) === false) {
            throw new \Exception("Could not put contents.");
        }
        return basename($filex);
    }
    else {
        throw new \Exception("No valid image provided with {$img}.");
    }
}
}