<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutuserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login')
            ->add('email')
            ->add('nom')
            ->add('prenom')

            ->add('datenaissance',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

     
                    'label' => false
    
    
    
    
            ])             ->add('genre', ChoiceType::class,[
                'choices' => [
                    'homme' => 'homme',
                    'femme' => 'femme',

                ],
                'expanded' => true
            ])
            ->add('tel')
            ->add('addresse')
            ->add('password',PasswordType::class)
            ->add('imageuser',FileType::class, array('data_class' => null))
            ->add("submit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
