<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {



        if($this->isGranted("IS_AUTHENTICATED_REMEMBERED") ){
            $user= $this->getUser();

            if ($user->hasRole('ROLE_ELEVE')){
            $eleve = $this->getUser()->getEleve();
            return $this->render('default/index.html.twig', [
                'submited' => !$eleve->getChoix()->isEmpty(),
            ]);
        }}

        return $this->render('default/index.html.twig');

    }

   
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $eleve = $user->getEleve();
        $em = $this->getDoctrine()->getManager();

        if ($user->hasRole('ROLE_ELEVE')) {
            $sexeEleve = $eleve->getSexe();
            $classeEleve = $eleve->getClasse();
            $promoEleve = $eleve->getPromo();
        }



        $form = $this->createForm('AppBundle\Form\UserType');
        $form1 = $this->createForm('AppBundle\Form\EleveType');

        $form->setData($user);
        $form1->setData($eleve);


        $form->handleRequest($request);
        $form1->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if ($user->hasRole('ROLE_ELEVE')){
                $eleve->setEmail($form->get('email')->getData());
            }
            else{
                $user->setEmail($form->get('email')->getData());
            }


            $user->setPassword($form->get('plainPassword')->getData());

            $em->flush();

            $this->addFlash('Info', "Les informations de connexion ont été mise à jour !");

        }


        if ($form1->isSubmitted() && $form1->isValid()) {

            $user->setEmail($form1->get('email')->getData());

            $eleve->setSexe($sexeEleve);
            $eleve->setClasse($classeEleve);
            $eleve->setPromo($promoEleve);

            $em->persist($eleve);

            $em->flush();

            $this->addFlash('Info', "Les informations personnelles ont été mise à jour !");

        }

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


            if ($user->hasRole('ROLE_ELEVE')){
            return $this->render('default/editprofil.html.twig', [
                'submited' => !$eleve->getChoix()->isEmpty(),
                'form' => $form->createView(),
                'form1' => $form1->createView(),
                'sexe' => $sexeEleve,
                'classe' => $classeEleve->getLibelle(),
                'promo' => $promoEleve->getAnnee(),

            ]);
        }

        return $this->render('default/editprofil.html.twig', [
            'form' => $form->createView(),
            'form1' => $form1->createView(),
        ]);
    }





}
