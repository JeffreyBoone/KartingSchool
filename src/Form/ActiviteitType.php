<?php
// src/App/Form/ActiviteitType
namespace App\Form;
use App\Entity\Activiteit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum', DateType::class, ['attr' => ['class' => 'js-datepicker', 'placeholder'=>'dd-mm-yyyy'],
            'widget'=>'single_text', 'html5' => false, 'format'=> 'dd-MM-yyyy'
               ])
            ->add('tijd', TimeType::class, ['attr' => ['class' => 'js-timepicker', 'placeholder'=>'hh:mm'],
                'widget'=>'single_text','html5' => false,])
            ->add('soort', EntityType::class,
                array('class' => 'App:Soortactiviteit',
                    'choice_label' => 'naam',))
        ->add('max_deelnemers', IntegerType::class, ['attr' => ['label' => 'Max deelnemers']]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Activiteit::class,
        ));

    }

}
