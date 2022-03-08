<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Voiture;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Matricule', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('Couleur', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('Carburant', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('marque', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('Categorie', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('DateDeMiseEnCirculation', DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']])
            ->add('Disponibilite')
            ->add('NbrdePlace', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
            ->add('prixparheure', TextType::class ,[
                'attr'=>['class'=>"form-control"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
