<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProjectType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title', TextType::class, 
				array('required'=>false,
						'label' => 'Title'
				))
		->add('route')
		->add('image',FileType::class, array('label' => 'Image (jpg/gif/png file)','required'=>false, 'data_class'=>null))
		->add('description')
		->add('meta');
		//->add('save', 'submit', array('attr' => array('class'=>'buttonx')));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'App\Entity\Project',
		));
	}

	public function getBlockPrefix()
	{
		return 'project';
	}
}