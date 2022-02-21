<?php

namespace App\Form;
 
use App\Entity\Chambre;
use App\Entity\Hotel;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('numChambre',TextType::class,[
            'attr'=>['placeholder'=>"N° de chambre",'class'=>"form-control"],
           
                'label' => false




        ])
            ->add('typeChambre',TextType::class,[
                'attr'=>['placeholder'=>"Type de chambre",'class'=>"form-control"],
               
                    'label' => false
    
    
    
    
            ])
            ->add('nbLit',TextType::class,[
                'attr'=>['placeholder'=>"Nombre de lits",'class'=>"form-control"],
               
                    'label' => false
            ])
            ->add('disponibilite',TextType::class,[
                'attr'=>['placeholder'=>"Disponibilité",'class'=>"form-control"],
               
                    'label' => false,
                    'data' => 'Disponible',

    
    
    
    
            ])
            ->add('vueChambre',TextType::class,[
                'attr'=>['placeholder'=>"Vue chambre",'class'=>"form-control"],
               
                    'label' => false
    
    
            ])
          ->add('prixNuit',TextType::class,[
                'attr'=>['placeholder'=>"Prix de chambre",'class'=>"form-control"],
               
                    'label' => false
    
    
            ])
              /*->add('prixNuit', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => TextType::class,
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'email-box'],

                ],
                'allow_add' => true,
                'prototype' => true 
            ])*/

           
            ->add('image', FileType::class, [
                'attr'=>['placeholder'=>"Images Chambre",'class'=>"form-control file-upload-info"],

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
            'data_class' => Chambre::class,
        ]);
    }
}
 