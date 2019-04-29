<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Choix;
use AppBundle\Entity\Proposition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Pays;
use AppBundle\Form\ChoixEtaType;
use AppBundle\Entity\Etablissement;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EleveController extends Controller
{

    /**
     * @Route("/eleve/choixdestination", name="choixdestination")
     */
    public function choixDestinationAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $eleve = $this->getUser()->getEleve();
        $form = $this->createForm(ChoixEtaType::class, $eleve);
        $choix = $eleve->getChoix();
        $noPays = $manager->getRepository('AppBundle:Pays')->find(1);


        if (!$eleve->getChoix()->isEmpty()) {


            /*            $this->addFlash('Info', "Voici vos choix : ");*/

            return $this->redirectToRoute('choixdestinationmodif');

        } else {


            $choix1 = new Choix();
            $choix2 = new Choix();
            $choix3 = new Choix();


            $form = $this->createForm(ChoixEtaType::class, $eleve);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if(
                    $form->get('choix1')->getData() ==  $noPays ||
                    $form->get('choix2')->getData() ==  $noPays ||
                    $form->get('choix3')->getData() ==  $noPays
                ){
                    $this->addFlash('Info', "Merci de choisir un pays !");

                }
                elseif ($form->get('choix1')->getData() == $form->get('choix3')->getData() ||
                    $form->get('choix1')->getData() == $form->get('choix2')->getData() ||
                    $form->get('choix2')->getData() == $form->get('choix3')->getData())
                {
                    $this->addFlash('Info', "Merci de choisir un pays différent !");

                }  else{


                    $choix1->setPays($form->get('choix1')->getData());
                    $choix2->setPays($form->get('choix2')->getData());
                    $choix3->setPays($form->get('choix3')->getData());


                    $eleve->addChoix($choix1);
                    $eleve->addChoix($choix2);
                    $eleve->addChoix($choix3);


                    //dump($form->getData());
                    //die;

                    $manager->persist($eleve);
                    $manager->flush();

                    return $this->redirectToRoute('choixdestination');
                }
            }
        }

        return $this->render('default/eleve/souhaitDestination.html.twig', [
            'form' => $form->createView(),
            'submited' => !$eleve->getChoix()->isEmpty(),
            'choix' => $choix,
        ]);

    }


    /**
     * @Route("/eleve/choixdestinationmodif", name="choixdestinationmodif")
     */
    public function choixDestinationModifAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $eleve = $this->getUser()->getEleve();
        $form = $this->createForm(ChoixEtaType::class, $eleve);
        $choix = $eleve->getChoix();
        $choixEleve = $manager->getRepository('AppBundle:Choix')->findBy(['eleve' => $eleve]);


        $erreur = false;


        if ($eleve->getChoix()->isEmpty()) {

            return $this->redirectToRoute('choixdestination');
        }
        else{


            $choix1 = $choixEleve[0];
            $choix2 = $choixEleve[1];
            $choix3 = $choixEleve[2];

            $form = $this->createForm(ChoixEtaType::class, $eleve);


            $form->get('choix1')->setData($choix1->getPays());
            $form->get('choix2')->setData($choix2->getPays());
            $form->get('choix3')->setData($choix3->getPays());


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {


                if ($form->get('choix1')->getData() == $form->get('choix3')->getData() ||
                    $form->get('choix1')->getData() == $form->get('choix2')->getData() ||
                    $form->get('choix2')->getData() == $form->get('choix3')->getData())
                {
                    $this->addFlash('Info', "Merci de choisir un pays différent !");
                    $erreur = true;

                }   else {


                    $em = $this->getDoctrine()->getManager();

                    $choixancien = $eleve->getChoix();


                    $validator = $this->get('validator');

                    $listErrors = $validator->validate($choixancien);

                    if(count($listErrors) > 0) {


                        return new Response(print_r($listErrors, true));

                    }
                    else{

                        $em->remove($choixancien[0]);
                        $em->remove($choixancien[1]);

                        $em->remove($choixancien[2]);

                        $em->flush();

                        $choix1->setPays($form->get('choix1')->getData());
                        $choix2->setPays($form->get('choix2')->getData());
                        $choix3->setPays($form->get('choix3')->getData());


                        $eleve->addChoix($choix1);
                        $eleve->addChoix($choix2);
                        $eleve->addChoix($choix3);


                        $manager->persist($eleve);
                        $manager->flush();

                        $this->addFlash('Info', "Modification réussi !");

                        $erreur = false;

                    }

                }
            }
        }


        return $this->render('default/eleve/souhaitDestinationModif.html.twig', [
            'form' => $form->createView(),
            'submited' => !$eleve->getChoix()->isEmpty(),
            'choix' => $choix,
            'erreur' => $erreur,

        ]);
    }

    /**
     * @Route("/eleve/consultationEU", name="consultationEU")
     */
    public function consultationEUAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $eleve = $this->getUser()->getEleve();

        $moyenne =  ( $eleve->getUE2Note() + $eleve->getUE1Note() ) / 2;


        return $this->render('default/eleve/consultationeu.html.twig', [
            'submited' => !$eleve->getChoix()->isEmpty(),
            'noteEu2' => $eleve->getUE2Note(),
            'noteEu1' => $eleve->getUE1Note(),
            'moyenne' => $moyenne,

        ]);

    }

    /**
     * @Route("/eleve/propositions", name="propositions")
     */
    public function propositionsAction(Request $request)
    {
        $eleve = $this->getUser()->getEleve();

        $user = $this->getUser();
        $id_eleve = $user->getEleve()->getId();
        $propositions = $this->getDoctrine()->getRepository(Proposition::class)->findByProposition($id_eleve);

        return $this->render('default/eleve/propositions.html.twig',[
            'submited' => !$eleve->getChoix()->isEmpty(),
            'user' => $user, 'proposition' => $propositions

        ]);

    }
}
