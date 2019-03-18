<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class EleveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('eleNom',TextType::class  ,['label' =>"Nom de l'eleve :"])
                ->add('elePrenom',TextType::class , ['label' =>"Prenom de l'eleve :"])
                ->add('eleSexe',TextType::class , ['label' =>"Sexe :"])
                ->add('eleDateNaissance' , DateType::class , ['label' =>"Date naissance :"])
                ->add('elePromo')
                ->add('eleEmail', EmailType::class , ['label' =>"Email eleve :"])
                ->add('eleEmailParent', EmailType::class , ['label' =>"Email Parent :"])
                ->add('eleMdp', PasswordType::class , ['label' =>"Mot de passe :"])
                ->add('eleCommentaireGeneral')
                ->add('eleTerreDesLangues' , CheckboxType::class , ['label' => 'terre des langues '])
                ->add('eleCommentaireChoix')
                ->add('eleVisaParent', CheckboxType::class , ['label' => 'Visa parent'])
                ->add('eleUE2Date',  DateType::class , ['label' =>"Date UE2:"])
                ->add('eleUE2Note')
                ->add('eleUE2Appreciation')
                ->add('eleType')
                ->add('eleUE1Date' ,  DateType::class , ['label' =>"Date UE1:"])
                ->add('eleUE1Note')
                ->add('eleUE1Appreciation')
                ->add('eleObtentionDiplome' , CheckboxType::class , ['label' => 'Obtention diplome '] ) 
                ->add('eleMention')
                ->add('eleCommentaire' , TextType::class , ['label' => 'Commentaire'])
                ->add('save', SubmitType::class , ['label' => 'Envoie']);
    }
    
    /**
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
