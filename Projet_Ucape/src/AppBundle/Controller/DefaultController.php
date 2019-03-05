<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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


        return $this->render('default/choixEtablissement.html.twig');

    }

    /**
     * @Route("/documentations", name="documentations")
     */
    public function documentationsAction(Request $request)
    {


        return $this->render('default/documentations.html.twig');

    }



    /**
     * @Route("/formPays", name="formPays")
     */
    public function formPaysAction(Request $request)
    {
        $pays = new pays();


        /* Creation du formulaire pour l'ajout d'un nouveau pays dans la bdd */
        $form = $this->createFormBuilder($pays)
            ->add('pay_libelle', TextType::class, ['label' => 'Nom du pays'])
            ->add('save', SubmitType::class, ['label' => 'Envoie'])
            ->getForm();


        /* Récupération et traitement du formulaire valide */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* Récuperation et insertion dans la bdd */
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pays);
            $entityManager->flush();

            /* redirection vers une page de confirmation */
            return $this->render('form\validForm.html.twig');
        }

            /* redirection vers la page du formulaire */
            return $this->render('form\addPays.html.twig', [
            'form' => $form->createView(),
        ]);

    }



}
