<?php

namespace App\Form;
use App\Entity\Menu;
 use App\Entity\CatMenu;
 use App\Entity\Categorie;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('NomPlat', TextType::class ,[
            'attr'=>['placeholder'=>"nom plat",'class'=>"form-control"],'label'=>false
        ])
            ->add('libPlat', TextType::class ,[
                'attr'=>['placeholder'=>"Description",'class'=>"form-control"],'label'=>false
            ])
           
            ->add('prixPlat', NumberType::class ,[
                'attr'=>['placeholder'=>"Prix",'class'=>"form-control"],'label'=>false
            ])
            
            ->add('Categorie',EntityType::class,['class' => Categorie::class,
            'choice_label' => 'libCat', 'label' => 'Catégorie'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
