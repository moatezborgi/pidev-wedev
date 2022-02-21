<?php

namespace App\Form;
use App\Entity\Hotel;
use App\Entity\ImageResto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id',TextType::class,[
            'attr'=>['placeholder'=>"Référence de l'hôtel",'class'=>"form-control"
        ],
 
                'label' => false




        ])
            ->add('nomHotel',TextType::class,[
                'attr'=>['placeholder'=>"Nom de l'hôtel",'class'=>"form-control"],
               
                    'label' => false


 

            ])
            ->add('villeHotel',TextType::class,[
                'attr'=>['placeholder'=>"Ville de l'hôtel",'class'=>"form-control"],

               
                    'label' => false





            ])
            ->add('nbEtoile',NumberType::class,[
                'attr'=>['placeholder'=>"Nombre d'étoiles",'class'=>"form-control",'min' => 1, 'max' => 100,'number'],
               
                    'label' => false
 
             ])
             ->add('image', FileType::class, [
                'attr'=>['placeholder'=>"Images hôtel",'class'=>"form-control file-upload-info"],

                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])
        ;
     }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class

            
        ]);
      
    }
}
