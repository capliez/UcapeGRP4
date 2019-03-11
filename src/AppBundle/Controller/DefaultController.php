<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Pays;

use AppBundle\Entity\Etablissement;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

               if($this->isGranted("IS_AUTHENTICATED_REMEMBERED") == null ){
                   return $this->redirectToRoute('fos_user_security_login');
               }

        return $this->render('default/index.html.twig');

    }

    /**
     * @Route("/articles/add", name="add_showarticle")
     */
    public function AddAction(Request $request)
    {

        
       return $this->redirectToRoute('homepage');

    }


    /**
     * @Route("/choixetablissement", name="choixetablissement")
     */
    public function choixetablissementAction(Request $request)
    {



        $builderform = $this->get('form.factory')->createBuilder(FormType::class);

        $builderform
        ->add('Choix1', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'nom',
        ])
        ->add('Choix2', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'nom',
        ])
        ->add('Choix3', EntityType::class, [
            'class' => Pays::class,
            'choice_label' => 'nom',
        ])
        ->add('cocherterrelangue',  CheckboxType::class, [
            'label' => "En cas d'impossibilité d'échanges, envisagez-vous de partir avec Terre des Langues? *",
            'required' => false,
        ])
        ->add('commentaire',  TextareaType::class, [
            'label' => "Commentaire",
            'required' => true,
        ])
        ->add('cochervisaparent',   CheckboxType::class, [
            'label' => "Visa du parent : ",
            'required' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Validation des souhaits',
        ]);

        $form = $builderform->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $post = $form->request->get('form');

            if($post['Choix1'] == "france"){
                die("ok");
            }

            // $manager=  $this->getDoctrine()->getManager();
            // $manager->flush();
            // return $this->redirectToRoute('homepage');
        
        }


        return $this->render('default/choixEtablissement.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/documentations", name="documentations")
     */
    public function documentationsAction(Request $request)
    {


        return $this->render('default/documentations.html.twig');

    }



}
