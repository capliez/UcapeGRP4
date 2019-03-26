<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('prenom')->add('sexe')->add('dateNaissance')->add('promo')->add('email')->add('emailParent')->add('mdp')->add('commentaireGeneral')->add('terreDesLangues')->add('commentaireChoix')->add('visaParent')->add('UE2Date')->add('UE2ThemeDossier')->add('UE2Note')->add('UE2Appreciation')->add('type')->add('UE1Date')->add('UE1Note')->add('UE1Appreciation')->add('obtentionDiplome')->add('mention')->add('commentaire')->add('anneeEntreePromo')->add('aVoyage')->add('classe');
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
