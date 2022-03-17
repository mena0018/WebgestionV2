<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login',TextType::class,[
                'label' => 'Pseudo',
                'required' => 'true'
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Prénom',
                'required' => 'true'
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Nom',
                'required' => 'true'
            ])
            ->add('groupe', EntityType::class,[
                'label' => 'Groupe',
                'class' => Groupe::class,
                'required' => 'true'
            ])
            ->add('address', TextType::class,[
                'label' => 'Adresse',
                'required' => 'true'
            ])
            ->add('city', TextType::class,[
                'label' => 'Ville',
                'required' => 'true'
            ])
            ->add('post_code', NumberType::class,[
                'label' => 'Code Postal',
                'invalid_message' => 'Veuillez saisir uniquement des chiffres',
                'required' => 'true',
                'html5' => true,
            ])
            ->add('tel', NumberType::class,[
                'label' => 'Numéro de téléphone',
                'invalid_message' => 'Veuillez saisir un numéro valide.',
                'html5' => true,
            ])
            ->add('date_nais', BirthdayType::class,[
                'label' => 'Date de Naissance',
                'format' => 'dd-MM-yyyy',
                'required' => 'true'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Ressaisissez le mot de passe'],
                'mapped' => false,
                'attr' => ['autocomplete' => 'nouveau mdp'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
