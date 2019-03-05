<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Langue;
use AppBundle\Entity\Task;

class FormController extends Controller
{

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


    /**
     * @Route("/formLangue", name="formLangue")
     */
    public function formLangueAction(Request $request)
    {
        $langue = new Langue();


        /* Creation du formulaire pour l'ajout d'un nouveau pays dans la bdd */
        $form = $this->createFormBuilder($langue)
            ->add('lan_libelle', TextType::class, ['label' => 'Intitulle de la langue'])
            ->add('save', SubmitType::class, ['label' => 'Envoie'])
            ->getForm();


        /* Récupération et traitement du formulaire valide */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* Récuperation et insertion dans la bdd */
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($langue);
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
