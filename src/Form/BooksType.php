<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'titre'
            ])
            ->add('description', TextareaType::class)
            ->add('author', TextType::class, [
                'label'=>'Auteur'
            ])
            ->add('isAvailable', ChoiceType::class, [
                'label'=>'Disponible',
                'choices'=> array(
                    'Oui'=>true,
                    'Non'=>false
                ),
                'required'=>true
            ])
            ->add('getAt', DateType::class, [
                'label'=>'Emprunté le :',
                'widget'=>'choice'
            ])
            ->add('getBackAt', DateType::class, [
                'label'=>'Remis le:',
                'widget'=>'choice'
            ])
            ->add('categorie')
            ->add('catalogue')
            ->add('img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
