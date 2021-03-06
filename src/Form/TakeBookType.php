<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TakeBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Titre',
            ])
            ->add('author', TextType::class, [
                'label'=>'auteur'
            ])
            ->add('takeBook', ChoiceType::class, [
                'label'=> 'Livre récupéré :',
                'choices' => [
                    'oui' => true,
                    'non' => false,
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
