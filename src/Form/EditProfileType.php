<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login',TextType::class,[
                'label' => 'Pseudo',
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Nom',
            ])
            ->add('address', TextType::class,[
                'label' => 'Adresse',
            ])
            ->add('city', TextType::class,[
                'label' => 'Ville',
            ])
            ->add('post_code', NumberType::class,[
                'label' => 'Code postal',
                'invalid_message' => 'Veuillez saisir uniquement des chiffres',
                'html5' => true,
            ])
            ->add('tel', NumberType::class,[
                'label' => 'Numéro de téléphone',
                'html5' => true,
            ])
            ->add('date_nais', BirthdayType::class,[
                'label' => 'Date de Naissance',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('mail', EmailType::class,[
                'label' => 'Email'
            ])
            ->add('Modifier',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
