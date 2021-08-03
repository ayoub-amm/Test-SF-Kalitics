<?php

namespace App\Form;

use App\Entity\Pointages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('utilisateur',EntityType::class,[
                'class' => 'App\Entity\Utilisateurs'
            ])
            ->add('chantier',EntityType::class,[
                'class' => 'App\Entity\Chantiers',
                'choice_label' => 'nom'
            ])
            
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable'
            ])
            ->add('duree',null,['label'=>'Durée'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointages::class,
        ]);
    }
}
