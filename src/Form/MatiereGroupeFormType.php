<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Matiere;
use App\Entity\MatiereGroupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereGroupeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matiere', EntityType::class, [
                'label' => 'Libellé de la matière',
                'class' => Matiere::class,
                'required' => true,
            ])
            ->add('groupe', EntityType::class, [
                'label' => 'Libellé du groupe',
                'class' => Groupe::class,
                'required' => true,
            ])
            ->add('ajouter', SubmitType::class, ['label' => 'Ajouter la matière au groupe'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MatiereGroupe::class,
        ]);
    }
}
