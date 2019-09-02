<?php

namespace App\Form;

use App\Entity\Transaction;
use App\Entity\TypeTransaction;
use App\Entity\UserPrestataire;
use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /*  ->add('date') */
        
        /* ->add('commission',EntityType::class,[
            'class'=> Tarif::class,
            'choice_label'=> 'Commission_id']) */
            ->add('montant')
            ->add('envoyeurNomComplet')
            ->add('envoyeurCni')
            ->add('recepteurNomComplet')
            ->add('recepteurCni')
           /*  ->add('libelle',EntityType::class,[
                'class'=> TypeTransaction::class,
                'choice_label'=> 'libelle_id']) */
             ->add('multiservice',EntityType::class,[
                'class'=> UserPrestataire::class,
                'choice_label'=> 'user_id']) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
            

        ]);
    }
}
