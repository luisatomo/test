<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('fullname', TextType::class, 
				array(
						'label' => 'Full Name'
				))
		->add('email')
		->add('body');
		//->add('save', 'submit', array('attr' => array('class'=>'buttonx')));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'App\Entity\Contact',
		));
	}

	public function getBlockPrefix()
	{
		return 'contact';
	}
}