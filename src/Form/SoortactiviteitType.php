<?php

namespace App\Form;

use App\Entity\Soortactiviteit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoortactiviteitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('minLeeftijd')
            ->add('tijdsduur')
            ->add('prijs')
            ->add('beschrijving')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Soortactiviteit::class,
        ]);
    }
}
