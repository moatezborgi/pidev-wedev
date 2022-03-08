<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Contrat;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('Datedebut', DateTimeType::class)
            ->add('dateretour', DateTimeType::class)
            ->add('voiturealouer', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => 'Matricule',
                'query_builder' => function (VoitureRepository $er)
                {
                    return $er->createQueryBuilder('v')
                        ->where('v.Disponibilite = 1'); }
            ]  ) ;


    }


    public function configureOptions(OptionsResolver $resolver): void
     {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
