<?php

namespace AppBundle\Form;

use AppBundle\Entity\Pays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

use Doctrine\ORM\EntityRepository;



class ChoixEtaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('choix1', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'libelle',
            'mapped' => false,
            'label' => "Choix 1",
            'placeholder' => "-- Choisir --",


        ])


        ->add('choix2', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'libelle',
            'mapped' => false,
            'label' => "Choix 2",
            'placeholder' => "-- Choisir --",
        ])


        ->add('choix3', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'libelle',
            'mapped' => false,
            'label' => "Choix 3",
            'placeholder' => "-- Choisir --",

        ])
        ->add('terreDesLangues', CheckboxType::class, [
            'label' => "En cas d'impossibilité d'échanges, envisagez-vous de partir avec Terre des Langues? ",
            'required' => false,
        ])
        ->add('commentaireChoix',  TextareaType::class, [
            'label' => "Commentaire",
            'required' => true,
        ])
        ->add('visaParent',   CheckboxType::class, [
            'label' => "Visa du parent ",
            'required' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => $options['is_edit'] ? 'Mettre à jour' : 'Valider',
        ]);    
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Eleve',
            'is_edit' => false,


        ));
    }


}