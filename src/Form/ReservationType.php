<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom',TextType::class,[
                'attr'=>['placeholder'=>"Nom",'class'=>"form-control"
            ]])
            ->add('Prenom',TextType::class,[
                'attr'=>['placeholder'=>"Prénom",'class'=>"form-control"
            ]])
            ->add('nb_perso',TextType::class,[
                'attr'=>['placeholder'=>"N°personnes",'class'=>"form-control"
            ]])
            ->add('tel',TextType::class,[
                'attr'=>['placeholder'=>"Téléphone",'class'=>"form-control"
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
