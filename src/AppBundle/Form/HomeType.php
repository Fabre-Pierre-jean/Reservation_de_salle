<?php

namespace AppBundle\Form;
use AppBundle\Entity\Domaine;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Formateur;
use AppBundle\Entity\Promo;
use AppBundle\Entity\Salle;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class HomeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('type', EntityType::class, [
                "label"         => "Type de salle recherché: ",
                'class'         => Domaine::class,
                'placeholder'   => 'Sélectionner une type',
            ])

//            $builder->get('type')->addEventListener(
//                FormEvents::POST_SUBMIT,
//                function (FormEvent $event){
//                    dump($event->getForm());
//                    dump($event->getForm()->getData());
//                    $form = $event->getForm();
//                    $form->getParent()->add('salle', EntityType::class, [
//                        'class'         =>  Salle::class,
//                        'placeholder'   => 'Selectionner la salle',
//                        'mapped'        => false,
//                        'required'      => false,
//                        'choices'       => [$form->getData()->getSpec(),
//                                            ]
//
//
//                    ]);
//                }
//            );
            ->add('day', ChoiceType::class, [
                "placeholder"   => "Selectionnez un jour de la semaine",
                "label"         => "Choississez le jour: ",
                "choices"       => [
                                    "Lundi"     => "Lundi",
                                    "Mardi"     => "Mardi",
                                    "Mercredi"  => "Mercredi",
                                    "Jeudi"     => "Jeudi",
                                    "Vendredi"  => "Vendredi"
                                    ]
            ])

            ->add('halfDay', ChoiceType::class, [
                "label"         => "Durée",
                "choices"   => [
                                "Matin"     => "Matin",
                                "Aprem"     => "Aprem",
                                "Journée"   => "Journée entière"
                                ],
                'multiple'  => false,
                'expanded'   => true
            ])

            ->add('formateur', EntityType::class, [
                'class'         => Formateur::class,
                'placeholder'   => 'Sélectionner une formateur'
                ])

            ->add('promo', EntityType::class, [
                'class'         => Promo::class,
            'placeholder'   => 'Sélectionner une promo',
        ])

            ->add('salle', EntityType::class, [
                'class'         => Salle::class,
                'placeholder'   => 'Sélectionner une salle'
                ]);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Home',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_home';
    }


}
