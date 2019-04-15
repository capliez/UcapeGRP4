<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Promotion;
use AppBundle\Form\PromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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


class AdminController extends Controller
{

    /**
     * @Route("/admin/promotion", name="promotion")
     */
    public function promotionAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();




        return $this->render('default/admin/promotion.html.twig', [
            'promotion' => $manager->getRepository('AppBundle:Promotion')->findAll(),

        ]);
    }

    /**
     * @Route("/admin/promotion/modifier/{id}", name="promotionmodif")
     */
    public function promotionModifAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $promo = $this->getDoctrine()->getRepository('AppBundle:Promotion')->find($id);
        $promotionAll = $em->getRepository('AppBundle:Promotion')->findAll();

        $promoexistant[] = null;
        $promodejaexistante = false;
        $erreur = false;


        if(null == $promo){
            throw new NotFoundHttpException("Désolé, la promotion n'a pas été trouvé ");
        }



        $form = $this->createForm('AppBundle\Form\PromotionType', $promo, [
            'is_edit' => true,

        ]);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){


            for ($i = 0 ; $i < count($promotionAll) ; $i++)
            {

                array_push($promoexistant, $promotionAll[$i]->getAnnee() );

                if($promotionAll[$i]->getId() != $promo->getId()){
                    if($form->get('annee')->getData() == $promotionAll[$i]->getAnnee()){
                        $promodejaexistante =  true;
                    }
                }

            }

            $validator = $this->get('validator');

            $listErrors = $validator->validate($promo);

            if(count($listErrors) > 0) {
                return new Response(print_r($listErrors, true));
            }
            else
            {

                if($promodejaexistante == true)
                {
                    $this->addFlash('Info', "Le nom existe déja ! ");
                    $erreur = true;

                }
                else{
                    $manager=  $this->getDoctrine()->getManager();


                    $manager->flush();

                    $this->addFlash('Info', "Bravo, mise à jour réussi !");
                }
            }


        }


        return $this->render('default/admin/promotionmodif.html.twig', [
            'form' => $form->createView(),
            'p' => $promo,
            'erreur' => $erreur,


        ]);
    }


    /**
     * @Route("/admin/promotion/supprimer/{id}", name="promotionsupp")
     */
    public function SupprimerPromotionaAction(Request $request, int $id)
    {

        $em = $this->getDoctrine()->getManager();

        $pro = $em->getRepository('AppBundle:Promotion')->find($id);

        if(null == $pro){
            throw new NotFoundHttpException("Désolé, la promotion n'a pas été trouvé ");
        }

        $em->remove($pro);
        $em->flush();


        return $this->redirectToRoute('promotion');

    }

    /**
     * @Route("/admin/promotion/ajouter", name="promotionajout")
     */
    public function promotionAjoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class, $promotion);
        $promotionAll = $em->getRepository('AppBundle:Promotion')->findAll();

        $promoexistant[] = null;
        $promodejaexistante = false;
        $erreur = false;

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            for ($i = 0 ; $i < count($promotionAll) ; $i++)
            {

                array_push($promoexistant, $promotionAll[$i]->getAnnee() );

                if($form->get('annee')->getData() == $promotionAll[$i]->getAnnee()){
                    $promodejaexistante =  true;
                }

            }



            $validator = $this->get('validator');

            $listErrors = $validator->validate($promotion);

            if(count($listErrors) > 0) {
                return new Response(print_r($listErrors, true));
            }
            else
            {

                if($promodejaexistante == true)
                {
                    $this->addFlash('Info', "Le nom existe déja ! ");
                    $erreur = true;

                }else{
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($promotion);
                    $manager->flush();
                    $this->addFlash('Info', "Bravo, promotion ajouté !");

                    unset($entity);
                    unset($form);
                    $promotion = new Promotion();
                    $form = $this->createForm(PromotionType::class, $promotion);
                }

            }


        }

        return $this->render('default/admin/promotionajout.html.twig', [
            'form' => $form->createView(),
            'erreur' => $erreur,
        ]);
    }


}
