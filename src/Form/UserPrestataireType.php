<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserPrestataire;
use Symfony\Component\Form\AbstractType;
use App\Entity\Prestataire;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Compte;

class UserPrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('contact')
            ->add('email')
            ->add('adresse')
            ->add('cni')
             ->add('matriculeEntreprise',EntityType::class,[
                'class'=> Prestataire::class,
                'choice_label'=> 'matriculeEntreprise_id'
                ])  
          /*   ->add('authent',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'authent_id'
                ]) */
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserPrestataire::class,
        ]);
    }
}
