<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classe;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Proposition;
use AppBundle\Form\PromotionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

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


    /**
 * @Route("/admin/gestionEU", name="gestionEU")
 */
    public function gestionEUAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lesEleves = $em->getRepository('AppBundle:Eleve')->findAll();


        return $this->render('default/admin/gestioneu.html.twig', [
            'lesEleves' => $lesEleves,
        ]);
    }

    /**
     * @Route("/admin/gestionEU/{nom}", name="gestionEUEleve")
     */
    public function gestionEUEleveAction(string $nom)
    {
        $em = $this->getDoctrine()->getManager();

        $eleve = $this->getDoctrine()->getRepository('AppBundle:Eleve')->findBy(['nom'=>$nom]);


        return $this->render('default/admin/gestioneueleve.html.twig', [
            'eleve' => $eleve[0],

        ]);
    }

    /**
     * @Route("/admin/listeeleves", name="listeeleves")
     */
    public function listeElevesAction(Request $request)
    {
        $eleves = $this->getDoctrine()->getRepository(Eleve::class)->findBy([], ['classe' => 'ASC']);
        $adapter = new ArrayAdapter($eleves);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/listeeleves.html.twig', [
            'paginator' => $pagerfanta , 'eleves' => $eleves
        ]);
    }

    /**
     * @Route("/admin/listeeleves/filtre", name="listeelevesfiltre")
     */
    public function listeElevesFiltreAction(Request $request)
    {
        $nom_prenom = $request->get('nom_prenom');
        $eleves = $this->getDoctrine()->getRepository(Eleve::class)->findByFilter($nom_prenom);
        $adapter = new ArrayAdapter($eleves);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/filtreEleve.html.twig', ['paginator' => $pagerfanta , 'eleves' => $eleves]);
    }

    /**
     * @Route("/admin/eleve/{id_eleve}", name="consultereleve")
     */
    public function consulterEleveAction(int $id_eleve)
    {

        $eleve = $this->getDoctrine()->getRepository('AppBundle:Eleve')->find($id_eleve);
        if (null === $eleve)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        return $this->render('default/admin/consulteEleve.html.twig', [
            'eleve' => $eleve
        ]);
    }

    /**
     * @Route("/eleves/edit/{id_eleve}", name="editioneleve")
     */
    public function editEleveAction(Request $request, $id_eleve)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $eleve = $entityManager->getRepository(Eleve::class)->find($id_eleve);

        if (!$eleve) {
            throw $this->createNotFoundException(
                "Pas d'élève ayant l'identifiant .$id_eleve"
            );
        }

        $builder = $this->get('form.factory')->createBuilder(FormType::class);

        $builder->add('eleNom',TextType::class  ,['label' =>"Nom de l'eleve :", 'data' => $eleve->getNom()])
            ->add('elePrenom',TextType::class , ['label' =>"Prenom de l'eleve :", 'data' => $eleve->getPrenom()])
            ->add('eleSexe',TextType::class , ['label' =>"Sexe :", 'data' => $eleve->getSexe()])
            ->add('eleDateNaissance' , BirthdayType::class , ['label' =>"Date naissance :", 'data' => $eleve->getDateNaissance()])
            ->add('promo',EntityType::class , ['class'=> Promotion::class, 'label' =>"Promo :", 'data' => $eleve->getPromotion()])
            ->add('eleEmail', EmailType::class , ['label' =>"Email eleve :", 'data' => $eleve->getEmail()])
            ->add('eleEmailParent', EmailType::class , ['label' =>"Email Parent :", 'data' => $eleve->getEmailParent()])
            ->add('classe',EntityType::class , ['class'=> Classe::class, 'label' =>"Classe:", 'data' => $eleve->getClasse()])
            ->add('utilisateur', EntityType::class, ['class' => User::class, 'label' =>"Utilisateur"])
            ->add('save', SubmitType::class , ['label' => 'Enregistrer']);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $eleve
                ->setNom($data["eleNom"])
                ->setPrenom($data["elePrenom"])
                ->setSexe($data["eleSexe"])
                ->setDateNaissance($data["eleDateNaissance"])
                ->setPromotion($data["promo"])
                ->setEmail($data["eleEmail"])
                ->setEmailParent($data["eleEmailParent"])
                ->setMdp($data["eleMdp"])
                ->setClasse($data["classe"])
                ->setUser($data["utilisateur"])
                ->setClasse($data["classe"])
            ;
            $entityManager->flush();

            return $this->redirectToRoute('listeeleves');

        }


        return $this->render('default/admin/editionEleve.html.twig', [
            'form' => $form->createView(),
            'eleve' => $eleve,
        ]);

    }

    /**
     * @Route("/admin/affectation/{id_eleve}", name="affectationeleve")
     */
    public function affectationEleveAction(Request $request, int $id_eleve)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $choix = $this->getDoctrine()->getRepository(Eleve::class)->findByChoix($id_eleve);
        $propositions = $this->getDoctrine()->getRepository(Proposition::class)->findByProposition($id_eleve);
        $pays = null;
        $etablissement = null;

        for($i = 0 ; $i < count($choix); $i++)
        {
            $pays[$i] = $this->getDoctrine()->getRepository(Pays::class)->findBy(['id' => $choix[$i]]);
            $etablissement[$i] = $this->getDoctrine()->getRepository(Etablissement::class)->findByEtablissement($choix[$i]["pays_id"]);
        }

        $eleve = $this->getDoctrine()->getRepository('AppBundle:Eleve')->find($id_eleve);
        if (null === $eleve)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        $builderform = $this->get('form.factory')->createBuilder(FormType::class);

        $builderform
            ->add('Etablissement', EntityType::class , ['label' => "Etablissement", 'class' => Etablissement::class, 'choice_label' => 'EtablissementPays'])
            ->add('DateDepart',  DateType::class , ['label' =>"Date départ"])
            ->add('DateFin',  DateType::class , ['label' =>"Date fin"])
            ->add('save', SubmitType::class, ['label' => 'Proposer']);



        $form = $builderform->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $newProposition = new Proposition();
            //$post = $form->request->get('form');
            $dataForm = $form->getData();
            $newProposition
                ->setEstAcceptee(null)
                ->setCommentaire(null)
                ->setDateDepart($dataForm["DateDepart"])
                ->setDateFin($dataForm["DateFin"])
                ->setEleve($eleve)
                ->setEtablissement($dataForm["Etablissement"])
            ;
            $entityManager->persist($newProposition);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('default/admin/affectationEleve.html.twig', [
            'eleve' => $eleve, 'choix' => $pays, 'proposition' => $propositions, 'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/supprimer/{id_eleve}", name="supprimereleve")
     */
    public function supprimerEleveAction($id_eleve)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $eleve = $entityManager->getRepository(Eleve::class)->find($id_eleve);

        if (!$eleve) {
            throw $this->createNotFoundException(
                "Pas d'élève ayant l'identifiant .$id_eleve"
            );
        }

        $entityManager->remove($eleve);
        $entityManager->flush();

        return $this->redirectToRoute('listeeleves');
    }






}
