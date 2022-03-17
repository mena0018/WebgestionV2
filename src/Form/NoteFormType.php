<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Matiere;
use App\Entity\MatiereGroupe;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('user', EntityType::class, [
               'label' => 'Choisir l\'élève',
               'class' => User::class,
               'query_builder' => function (EntityRepository $er) {
                   return $er->createQueryBuilder('u')
                       ->orderBy('u.lastname', 'ASC');
               },
               'required' => true,
           ])
            ->add('valeur', IntegerType::class, [
                'label' => 'Note',
                'required' => true,
            ])
            ->add('coefficient', IntegerType::class, [
                'label' => 'Coefficient',
                'required' => true,
            ])
            ->add('matiere', EntityType::class, [
                'label' => 'Matière',
                'class' => Matiere::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.intitule', 'ASC');
                },
                'required' => true,
            ])
            ->add('Ajouter',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
