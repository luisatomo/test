<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title', TextType::class, 
				array('required'=>false,
						'label' => 'Page Title'
				))
		->add('route')
		->add('published')
		->add('description')
		->add('meta')
		->add('body');
		//->add('save', 'submit', array('attr' => array('class'=>'buttonx')));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'App\Entity\Post',
		));
	}

	public function getBlockPrefix()
	{
		return 'post';
	}
}