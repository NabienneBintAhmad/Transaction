<?php

namespace App\Form;

use App\Entity\UserPrestataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserPrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('contact')
            ->add('email')
            ->add('Adresse')
            ->add('cni')
            ->add('matriculeEntreprise')
            ->add('authent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserPrestataire::class,
        ]);
    }
}
