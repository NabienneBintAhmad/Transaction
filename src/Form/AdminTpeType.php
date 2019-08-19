<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminTpeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('email')
            ->add('contact')
            ->add('cni')
          /*   ->add('authent',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'authent_id'
                ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
