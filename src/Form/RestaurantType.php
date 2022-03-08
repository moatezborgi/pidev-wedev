<?php

namespace App\Form;

use App\Entity\Restaurant;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('referResto', TextType::class ,[
                'attr'=>['placeholder'=>"reference de restaurant",'class'=>"form-control"],'label'=>false
            ])
            ->add('nomResto', TextType::class ,[
                'attr'=>['placeholder'=>"Nom du restaurant",'class'=>"form-control"],'label'=>false
            ])
            ->add('adresseResto', TextType::class ,[
                'attr'=>['placeholder'=>"Adresse",'class'=>"form-control"],'label'=>false
            ])
            ->add('tel', NumberType::class ,[
                'attr'=>['placeholder'=>"telephone de restaurant",'class'=>"form-control"],'label'=>false
            ])
            ->add('nbEtoile', NumberType::class ,[
                'attr'=>['placeholder'=>"Nombre d'étoile",'class'=>"form-control"],'label'=>false
            ])
            ->add('Categorie',EntityType::class,['class' => Categorie::class,
             'choice_label' => 'libCat', 'label' => 'Catégorie'])

            ->add('image', FileType::class, [
                    'attr'=>['placeholder'=>"Images Restaurant",'class'=>"form-control file-upload-info"],
                    'label' => false,
                    'multiple' => true,
                    'mapped' => false,
                    'required' => true
                ]);
                         
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
