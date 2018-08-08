<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
            ->add('username')
            ->add('plainpassword', PasswordType::class)
            ->add('roles', ChoiceType::class, [
            		'multiple' => true,
            		'expanded' => true, // render check-boxes
            		'choices' => [
            				'Admin' => 'ROLE_ADMIN',
            				'Customer' => 'ROLE_USER'
            		]]);
	}

}