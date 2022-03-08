<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'attr'=>['placeholder'=>"Titre",'class'=>"form-control"],
               
                    'label' => false
    
    
    
    
            ])
            ->add('start',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

     
                    'label' => false
    
    
    
    
            ])
            ->add('end',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

     
                    'label' => false
    
    
    
    
            ])
            ->add('description',TextType::class,[
                'attr'=>['placeholder'=>"Description",'class'=>"form-control"],
               
                    'label' => false
    
    
    
    
            ])
            ->add('all_day', CheckboxType::class)
            ->add('background_color',ColorType::class)
            ->add('bordor_color',ColorType::class )
            ->add('text_color',ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
