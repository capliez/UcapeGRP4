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
use AppBundle\Entity\Classe;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Langue;
use AppBundle\Entity\Task;
use AppBundle\Form\PaysType;
use AppBundle\Form\LangueType;
use AppBundle\Form\ClasseType;
use AppBundle\Form\EleveType;

class FormController extends Controller
{

    /**
     * @Route("/formPays", name="formPays")
     */
    public function formPaysAction(Request $request)
    {    
        $pays = new Pays;


        $form = $this->get('form.factory')->create(PaysType::class, $pays);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($pays);
            $em->flush();
    
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
    
            return $this->redirectToRoute('homepage', array('id' => $pays->getId()));
    
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
        $langue = new Langue;
        $form = $this->get('form.factory')->create(LangueType::class, $langue);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($langue);
            $em->flush();
    
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
    
            return $this->redirectToRoute('homepage', array('id' => $langue->getId()));
    
        }
            /* redirection vers la page du formulaire */
            return $this->render('form\addLangues.html.twig', [
                'form' => $form->createView(),
            ]);
    }


    
    /**
     * @Route("/formClasse", name="formClasse")
     */
    public function formClasseAction(Request $request)
    {
        $classe = new Classe;
        $form = $this->get('form.factory')->create(ClasseType::class, $classe);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();
    
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
    
            return $this->redirectToRoute('homepage', array('id' => $classe->getId()));
    
        }
        /* redirection vers la page du formulaire */
        return $this->render('form\addPays.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    
    /**
     * @Route("/formEleve", name="formEleve")
     */
    public function formEleveAction(Request $request)
    {
        $eleve = new Eleve;
        $form = $this->get('form.factory')->create(EleveType::class, $eleve);
        dump ($eleve);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($eleve);
            $em->flush();
    
            return $this->redirectToRoute('homepage');
    
        }
            /* redirection vers la page du formulaire */
            return $this->render('form\addEleve.html.twig', [
                'form' => $form->createView(),
            ]);
    }

}
