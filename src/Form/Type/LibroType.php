<?php

namespace App\Form\Type;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\Type\AutorType;
use App\Entity\Autor;

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
		->add('autores', EntityType::class, array(
			'required'=>true,
				'multiple' => true,   // Multiple selection allowed
				'expanded' => true,   // Render as checkboxes // Assuming that the entity has a "name" property
				'class'    => Autor::class
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