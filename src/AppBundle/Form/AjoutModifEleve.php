<?php

namespace AppBundle\Form;

use AppBundle\Entity\Classe;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

use Doctrine\ORM\EntityRepository;



class AjoutModifEleve extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class  ,['label' =>"Nom de l'eleve :"])
            ->add('prenom',TextType::class , ['label' =>"Prenom de l'eleve :"])
            ->add('sexe',ChoiceType::class,[
                'choices'  => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Non binaire' => 'Non binaire',
                ],])
            ->add('dateNaissance' , BirthdayType::class , ['label' =>"Date naissance :"])
            ->add('promotion',EntityType::class , [
                'class'=> Promotion::class,
                'label' =>"Promo :"
            ])
            ->add('email', EmailType::class , ['label' =>"Email eleve :"])
            ->add('emailParent', EmailType::class , ['label' =>"Email Parent :"])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'label' =>"Classe: "
            ])
            ->add('submit', SubmitType::class , [
                'label' => $options['is_edit'] ? 'Modifier' : 'Ajouter',
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