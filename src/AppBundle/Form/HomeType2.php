<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeType2 extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('formateur')
            ->add('day', ChoiceType::class, [
                "choices" => [
                    "Lundi" => "Lundi",
                    "Mardi" => "Mardi",
                    "Mercredi" => "Mercredi",
                    "Jeudi" => "Jeudi",
                    "Vendredi" => "Vendredi"
                ]
            ])
            ->add('halfDay', ChoiceType::class, [
                "choices" => [
                    "Matin" => "Matin",
                    "Aprem" => "Aprem"
                ],
                'multiple' => false,
                'expanded' => true
            ])
            ->add('salle')
            ->add('promo')
            ->add('type');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Home2'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_home2';
    }


}
