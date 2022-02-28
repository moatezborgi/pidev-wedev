<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\Reclamation;
use App\Entity\TypeReclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\ChoiceList;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('TypeReclamation', EntityType::class, [
                'class' => TypeReclamation::class,
                'choice_label' => 'type'
            ])
            ->add('description')
            ->add('etat',ChoiceType::class,[
                'choices'  => [
                    'traité' => true,
                    'encourss' => false,
                ],            ])
            ->add('count')
            ->add('remboursement');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
