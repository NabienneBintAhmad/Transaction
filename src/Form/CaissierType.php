<?php

namespace App\Form;

use App\Entity\Caissier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaissierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('matricule')
            ->add('adresse')
            ->add('email')
            ->add('contact')
            ->add('cni')
            ->add('statut')
            ->add('role')
            ->add('authen')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caissier::class,
        ]);
    }
}
