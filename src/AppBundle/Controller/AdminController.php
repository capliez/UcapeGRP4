<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classe;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Proposition;
use AppBundle\Form\AjoutEleve;
use AppBundle\Form\AjoutModifEleve;
use AppBundle\Form\ModifierEleve;
use AppBundle\Form\PromotionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

        $adapter = new ArrayAdapter($lesEleves);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/gestioneu.html.twig', [
            'paginator' => $pagerfanta ,
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
     * @Route("/admin/eleve/ajouter", name="ajoutereleve")
     */
    public function ajouterEleveAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $emailExistant = false;
        $emaildejaexistant[] = null;

        $listedeseleves = $entityManager->getRepository('AppBundle:Eleve')->findAll();

        $erreur = false;
        $eleve = new Eleve();


        $form = $this->createForm(AjoutModifEleve::class, $eleve);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){




            for ($i = 0 ; $i < count($listedeseleves) ; $i++)
            {

                array_push($emaildejaexistant, $listedeseleves[$i]->getEmail() );

                if($form->get('email')->getData() == $listedeseleves[$i]->getEmail()){
                    $emailExistant =  true;
                }

            }


            if($emailExistant == true){
                $erreur = true;
                $this->addFlash('Info', "L'email existe dèja");

            }else{
                $eleve->setNom($form->get('nom')->getData());
                $eleve->setPrenom($form->get('prenom')->getData());
                $eleve->setSexe($form->get('sexe')->getData());
                $eleve->setDateNaissance($form->get('dateNaissance')->getData());
                $eleve->setPromotion($form->get('promotion')->getData());
                $eleve->setEmail($form->get('email')->getData());
                $eleve->setEmailParent($form->get('emailParent')->getData());
                $eleve->setClasse($form->get('classe')->getData());
                $entityManager->persist($eleve);
                $entityManager->flush();



                $this->addFlash('Info', "Bravo, l'éléve a bien été créé");
            }

        }

        return $this->render('default/admin/ajoutEleve.html.twig', [
            'form' => $form->createView(),
            'erreur' => $erreur,
        ]);

    }

    /**
     * @Route("/admin/liste_eleves", name="listeeleves")
     */
    public function listeElevesAction(Request $request)
    {
        $eleves = $this->getDoctrine()->getRepository(Eleve::class)->findBy([], ['classe' => 'ASC']);
        $adapter = new ArrayAdapter($eleves);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/listeeleves.html.twig', [
            'paginator' => $pagerfanta ,
            'eleves' => $eleves
        ]);
    }

    /**
     * @Route("/admin/liste_eleves/filtre", name="listeelevesfiltre")
     */
    public function listeElevesFiltreAction(Request $request)
    {
        $nom_prenom = $request->get('nom_prenom');
        $eleves = $this->getDoctrine()->getRepository(Eleve::class)->findByFilter($nom_prenom);
        $adapter = new ArrayAdapter($eleves);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/filtreEleve.html.twig', ['paginator' => $pagerfanta , 'eleves' => $eleves]);
    }

    /**
     * @Route("/admin/eleve/{nom}", name="consultereleve")
     */
    public function consulterEleveAction(string $nom)
    {

        $eleve = $this->getDoctrine()->getRepository('AppBundle:Eleve')->findBy(['nom' => $nom]);
        if (null === $eleve)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        return $this->render('default/admin/consulteEleve.html.twig', [
            'eleve' => $eleve[0]
        ]);
    }

    /**
     * @Route("/eleves/modifier/{id_eleve}", name="editioneleve")
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

        $form = $this->createForm(AjoutModifEleve::class, $eleve,[
            'is_edit' => true
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $entityManager->flush();

            $this->addFlash('Info', "Bravo, l'éléve a bien été mis à jour");

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

    /**
     * @Route("/admin/liste_utilisateur", name="listeutilisateur")
     */
    public function listeUtilisateurAction()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(User::class)->findAll();
        $adapter = new ArrayAdapter($utilisateurs);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage(1);
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        return $this->render('default/admin/listeutilisateurs.html.twig', [
            'paginator' => $pagerfanta , 'utilisateurs' => $utilisateurs
        ]);
    }

    /**
     * @Route("/admin/utilisateur/ajouter", name="ajouterutilisateur")
     */
    public function ajoutUtilisateurAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $builder = $this->get('form.factory')->createBuilder(FormType::class);

        $builder->add('username',TextType::class  ,['label' =>"Username :", 'data' => $user->getUsername()])
            ->add('userEmail', EmailType::class , ['label' =>"Email utilisateur :", 'data' => $user->getEmail()])
            ->add('userMdp', TextType::class , ['label' =>"Mot de passe utilisateur :", 'data' => $user->getPassword()])
            ->add('save', SubmitType::class , ['label' => 'Enregistrer']);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $user
                ->setUsername($data["username"])
                ->setEmail($data["userEmail"])
                ->setPassword($data["userMdp"])
                ->setRoles(['ROLE_ELEVE'])
            ;
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('listeutilisateur');

        }

        return $this->render('default/admin/ajoutUtilisateurs.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/utilisateur/{id_utilisateur}", name="afficheutilisateur")
     */
    public function afficherUtilisateurAction(int $id_utilisateur)
    {

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id_utilisateur);
        if (null === $user)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        return $this->render('default/admin/afficheUtilisateur.html.twig', [
            'utilisateur' => $user
        ]);
    }

    /**
     * @Route("/admin/utilisateur/modifier/{id_utilisateur}", name="modifierutilisateur")
     */
    public function modifierUtilisateurAction(Request $request, $id_utilisateur)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id_utilisateur);

        if (!$user) {
            throw $this->createNotFoundException(
                "Pas d'élève ayant l'identifiant $id_utilisateur"
            );
        }

        $builder = $this->get('form.factory')->createBuilder(FormType::class);

        $builder->add('username',TextType::class  ,['label' =>"Username :", 'data' => $user->getUsername()])
            ->add('userEmail', EmailType::class , ['label' =>"Email utilisateur :", 'data' => $user->getEmail()])
            ->add('userMdp', TextType::class , ['label' =>"Mot de passe utilisateur :", 'data' => $user->getPassword()])
            ->add('save', SubmitType::class , ['label' => 'Enregistrer']);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //$post = $form->request->get('form');
            $data = $form->getData();

            $user
                ->setUsername($data["username"])
                ->setEmail($data["userEmail"])
                ->setPassword($data["userMdp"])
            ;
            $entityManager->flush();

            return $this->redirectToRoute('listeutilisateur');

        }


        return $this->render('default/admin/modifierUtilisateur.html.twig', [
            'form' => $form->createView(),
            'utilisateur' => $user,
        ]);

    }

    /**
     * @Route("/admin/utilisateur/supprimer/{id_utilisateur}", name="supprimerutilisateur")
     */
    public function supprimerUtilisateurAction($id_utilisateur)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id_utilisateur);

        if (!$user) {
            throw $this->createNotFoundException(
                "Pas d'utilisateur ayant l'identifiant $id_utilisateur"
            );
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('listeutilisateur');
    }






}
