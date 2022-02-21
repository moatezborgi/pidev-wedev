<?php

namespace App\Form;

use App\Entity\Offrevoyage;
use App\Entity\Hotel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class OffrevoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id',TextType::class,[
                'attr'=>['placeholder'=>"Référence de lOffre",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('prix_offre',TextType::class,[
                'attr'=>['placeholder'=>"Prix Offre",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('nb_place',TextType::class,[
                'attr'=>['placeholder'=>"Nombre de place disponible",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('descriptions',TextType::class,[
                'attr'=>['placeholder'=>"Description",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('lieu_depart',TextType::class,[
                'attr'=>['placeholder'=>"Lieu de départ",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('lieu_arrivee',TextType::class,[
                'attr'=>['placeholder'=>"Destination",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('nb_nuits',TextType::class,[
                'attr'=>['placeholder'=>"N° nuits",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('nb_jours',TextType::class,[
                'attr'=>['placeholder'=>"N° jours",'class'=>"form-control"
            ],
     
                    'label' => false
    
    
    
    
            ])
            ->add('date_depart',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

     
                    'label' => false
    
    
    
    
            ])
            ->add('date_retour',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
     
                    'label' => false,
                   
    
    
    
    
            ])
            ->add('hotel',EntityType::class,['class' => Hotel::class,
            'choice_label' => 'nomHotel',
          
            'label' => false,
            'attr'=>['placeholder'=>"Référence de lOffre",'class'=>"form-control"]
            ])
            ->add('image', FileType::class, [
                'attr'=>['placeholder'=>"Images Offre",'class'=>"form-control file-upload-info"],
                
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
            'data_class' => Offrevoyage::class,
        ]);
    }
}
