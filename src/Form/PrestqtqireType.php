<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Prestataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestqtqireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('nomEntreprise')
            ->add('adresse')
            ->add('contact')
            ->add('cni')
            ->add('email')
            ->add('admin',EntityType::class,[
                'class'=> Admin::class,
                'choice_label'=> 'admin_id'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
