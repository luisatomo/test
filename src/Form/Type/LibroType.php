<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class LibroType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('titulo', TextType::class, 
				array('required'=>true,
						'label' => 'Titulo'
				))
		->add('fecha',DateType::class,
			array('required'=> true,
			'label'=> 'Edicion'))
		->add('autores', CollectionType::class, array(
				'entry_type' => AutorType::class,
				'entry_options' => array('label' => false),
				'allow_add' => true,
				'prototype' => true,
				'by_reference' => true,
				'allow_delete' => true,
				'required' => false,
			));
		//->add('save', 'submit', array('attr' => array('class'=>'buttonx')));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'App\Entity\Libro',
		));
	}

	public function getBlockPrefix()
	{
		return 'libro';
	}
}