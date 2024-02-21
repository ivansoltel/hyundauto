<?php

namespace App\Form;

use App\Entity\Coches;
use App\Entity\Modelos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CochesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricula')
            ->add('precio')
            ->add('estado')
            ->add('kms')
            ->add('fecha')
            ->add('id_modelo', EntityType::class, [
                'class' => Modelos::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coches::class,
        ]);
    }
}
