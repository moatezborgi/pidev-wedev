<?php

namespace App\Form;

use App\Entity\Reservation1;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class Reservation1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('date_reservation',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('time',TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('nb_perso',TextType::class,[
                'attr'=>['placeholder'=>"Votre Nom",'class'=>"form-control"]
            ])
         
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation1::class,
        ]);
    }
}
