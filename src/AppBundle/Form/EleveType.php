<?php

namespace AppBundle\Form;

use AppBundle\Entity\Eleve;
use AppBundle\Entity\Promotion;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EleveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('prenom')
        ->add('sexe', ChoiceType::class,[
            'choices'  => [
                'Homme' => 'Homme',
                'Femme' => 'Femme',
                'Non binaire' => 'Non binaire',
            ],
        ] )
        ->add('dateNaissance', BirthdayType::class)
        ->add('email')
        ->add('emailParent')
        ->add('commentaireGeneral', TextareaType::class, [
            'label' => 'Autres informations'
        ])

        ->add('classe')
        ->add('promotion', EntityType::class,[
            'class' => Promotion::class,
            'choice_label' => 'annee',
            ])
        ->add('submit', SubmitType::class, array('label' => 'Modifier'))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Eleve'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eleve';
    }


}
