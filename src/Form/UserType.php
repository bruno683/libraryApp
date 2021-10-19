<?php

namespace App\Form;

use App\Entity\Books;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('roles', CollectionType::class, [
                'entry_type'=> ChoiceType::class,
                'entry_options' => [
                    'choices'=> [
                        'ROLE_EMPLOYEE'=>'ROLE_EMPLOYEE',
                        'ROLE_USER'=>'ROLE_USER'
                    ]
                ]
            ])
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('postalAdress', TextType::class)
            ->add('dateOfBirth', DateType::class, [
                'label'=> 'Date de naissance :',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('isValid', ChoiceType::class, [
                'label' => 'Est Enregistré',
                'choices' => [
                    'yes' => true,
                    'no' => false
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
