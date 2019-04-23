<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Classe;
use AppBundle\Entity\Etablissement;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Proposition;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

use Pagerfanta\Adapter\ArrayAdapter;

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
     * @Route("/eleves/delete/{id_eleve}", name="delete_eleve")
     */
    public function deleteEleveAction($id_eleve)
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

        return $this->redirectToRoute('eleves');
    }

    /**
     * @Route("/eleves/new", name="create_eleve")
     */
    public function createEleveAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $builder = $this->get('form.factory')->createBuilder(FormType::class);

        $builder->add('eleNom',TextType::class  ,['label' =>"Nom de l'eleve :"])
                ->add('elePrenom',TextType::class , ['label' =>"Prenom de l'eleve :"])
                ->add('eleSexe',TextType::class , ['label' =>"Sexe :"])
                ->add('eleDateNaissance' , BirthdayType::class , ['label' =>"Date naissance :"])
                ->add('promo',EntityType::class , ['class'=> Promotion::class,'label' =>"Promo :"])
                ->add('eleEmail', EmailType::class , ['label' =>"Email eleve :"])
                ->add('eleEmailParent', EmailType::class , ['label' =>"Email Parent :"])
                ->add('eleMdp', TextType::class , ['label' =>"Mot de passe :"])
                ->add('classe', EntityType::class, ['class' => Classe::class, 'label' =>"Classe: "])
                ->add('save', SubmitType::class , ['label' => 'Enregistrer']);
            

        $form = $builder->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $eleve = new Eleve();
            //$post = $form->request->get('form');
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
            ;
            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('eleves');
        }


        return $this->render('default/create_eleve.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/eleves", name="eleves")
     */
    public function eleveAction()
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
        
        return $this->render('default/eleves.html.twig', ['paginator' => $pagerfanta , 'eleves' => $eleves]);
    }

    /**
     * @Route("/eleves/filtre", name="filtre_eleve")
     */
    public function filtreEleveAction(Request $request)
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
        
        return $this->render('default/filtre_eleve.html.twig', ['paginator' => $pagerfanta , 'eleves' => $eleves]);
    }

    /**
     * @Route("/eleves/{id_eleve}", name="affiche_eleve")
     */
    public function eleveConsultationAction(int $id_eleve)
    {
        
        $eleve = $this->getDoctrine()->getRepository('AppBundle:Eleve')->find($id_eleve);
        if (null === $eleve)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        return $this->render('default/affiche_eleve.html.twig', [
            'eleve' => $eleve
        ]);
    }

    /**
     * @Route("/eleves/edit/{id_eleve}", name="edit_eleve")
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
                ->add('eleMdp', TextType::class , ['label' =>"Mot de passe :", 'data' => $eleve->getMdp()])
                ->add('classe',EntityType::class , ['class'=> Classe::class, 'label' =>"Classe:", 'data' => $eleve->getClasse()])
                // ->add('eleCommentaireGeneral', TextAreaType::class , ['label' =>"Commentaire général :", 'data' => $eleve->getCommentaireGeneral()])
                // ->add('eleTerreDesLangues' , CheckboxType::class , ['label' => 'terre des langues', 'data'=> $eleve->getTerreDesLangues()])
                // ->add('eleCommentaireChoix', TextAreaType::class , ['label' =>"Commentaire choix :", 'data' => $eleve->getCommentaireChoix()])
                // ->add('eleVisaParent', CheckboxType::class , ['label' => 'Visa parent', 'data' => $eleve->getVisaParent()])
                // ->add('eleUE2Date',  DateType::class , ['label' =>"Date UE2:", 'data' => $eleve->getUE2Date()])
                // ->add('eleUE2Note', TextType::class , ['label' =>"Note UE2 :", 'data' => $eleve->getUE2Note()])
                // ->add('eleUE2Appreciation', TextAreaType::class , ['label' =>"Appréciation UE2 :", 'data' => $eleve->getUE2Appreciation()])

                // ->add('eleUE1Date' ,  DateType::class , ['label' =>"Date UE1:", 'data' => $eleve->getUE1Date()])
                // ->add('eleUE1Note', TextType::class , ['label' =>"Note UE1 :", 'data' => $eleve->getUE1Note()])
                // ->add('eleUE1Appreciation', TextAreaType::class , ['label' =>"Appreciation UE1 :", 'data' => $eleve->getUE1Appreciation()])
                // ->add('eleObtentionDiplome' , CheckboxType::class , ['label' => 'Obtention diplome ', 'data' => $eleve->getObtentionDiplome()] ) 
                // ->add('eleMention',TextType::class , ['label' =>"Mention :", 'data' => $eleve->getMention()])
                // ->add('eleCommentaire' , TextType::class , ['label' => 'Commentaire', 'data' => $eleve->getCommentaire()])
                ->add('save', SubmitType::class , ['label' => 'Enregistrer']);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //$post = $form->request->get('form');
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
            // ->setCommentaireGeneral($data["eleCommentaireGeneral"])
            // ->setTerreDesLangues($data["eleTerreDesLangues"])
            // ->setCommentaireChoix($data["eleCommentaireChoix"])
            // ->setVisaParent($data["eleVisaParent"])
            // ->setUE2Date($data["eleUE2Date"])
            // ->setUE2Note($data["eleUE2Note"])
            // ->setUE2Appreciation($data["eleUE2Appreciation"])
            // ->setType($data["eleType"])
            // ->setUE1Date($data["eleUE1Date"])
            // ->setUE1Note($data["eleUE1Note"])
            // ->setUE1Appreciation($data["eleUE1Appreciation"])
            // ->setMention($data["eleMention"])
            // ->setObtentionDiplome($data["eleObtentionDiplome"])
            // ->setCommentaire($data["eleCommentaire"])
            ->setClasse($data["classe"])
            ;
            $entityManager->flush();

            // $manager=  $this->getDoctrine()->getManager();
            // $manager->flush();
            return $this->redirectToRoute('eleves');
        
        }


        return $this->render('default/edit_eleve.html.twig', [
            'form' => $form->createView(),
            'eleve' => $eleve,
        ]);

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

    /**
     * @Route("/eleves/affectation/{id_eleve}", name="affectation_eleve")
     */
    public function eleveAffectationAction(Request $request, int $id_eleve)
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
        ->add('Etablissement', EntityType::class, [
            'class' => Etablissement::class,
            'choice_label' => 'EtablissementPays',
        ])
        ->add('DateDepart',  DateType::class , ['label' =>"Date départ"])
        ->add('DateFin',  DateType::class , ['label' =>"Date fin"])
        ->add('save', SubmitType::class, ['label' => 'Proposer']);

        /* à voir s'il faut que les choix de la liste soient par rapport aux choix de l'élève ou non
        $builderform
        ->add('Etablissement', ChoiceType::class, [
            'choices' => $data,
        ]);
        */



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

        return $this->render('default/affectation_eleve.html.twig', [
            'eleve' => $eleve, 'choix' => $pays, 'proposition' => $propositions, 'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/propositions", name="propositions")
     */
    public function propositionsAction(Request $request)
    {
        $user = $this->getUser();
        $id_eleve = $user->getEleve()->getId();
        $propositions = $this->getDoctrine()->getRepository(Proposition::class)->findByProposition($id_eleve);

        return $this->render('default/consultation_proposition.html.twig', ['user' => $user, 'proposition' => $propositions ]);

    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function utilisateursAction()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(User::class)->findAll();
        $adapter = new ArrayAdapter($utilisateurs);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage(1); 
        if (isset($_GET["page"])) {
            $pagerfanta->setCurrentPage($_GET["page"]);
        }

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();
        
        return $this->render('default/utilisateurs.html.twig', ['paginator' => $pagerfanta , 'utilisateurs' => $utilisateurs]);
    }

     /**
     * @Route("/utilisateurs/new", name="create_utilisateur")
     */
    public function createUtilisateurAction(Request $request)
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
            ;
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateurs');
        
        }

        return $this->render('default/create_utilisateur.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/utilisateurs/{id_utilisateur}", name="affiche_utilisateur")
     */
    public function utilisateurConsultationAction(int $id_utilisateur)
    {
        
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id_utilisateur);
        if (null === $user)
        {
            throw new NotFoundHttpException("désolé la page n'a pas été trouvée");
        }

        return $this->render('default/affiche_utilisateur.html.twig', [
            'utilisateur' => $user
        ]);
    }

    /**
     * @Route("/utilisateurs/edit/{id_utilisateur}", name="edit_utilisateur")
     */
    public function editUtilisateurAction(Request $request, $id_utilisateur)
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

            // $manager=  $this->getDoctrine()->getManager();
            // $manager->flush();
            return $this->redirectToRoute('utilisateurs');
        
        }


        return $this->render('default/edit_utilisateur.html.twig', [
            'form' => $form->createView(),
            'utilisateur' => $user,
        ]);

    }

    /**
     * @Route("/utilisateurs/delete/{id_utilisateur}", name="delete_utilisateur")
     */
    public function deleteUtilisateurAction($id_utilisateur)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id_utilisateur);

        if (!$user) {
            throw $this->createNotFoundException(
                "Pas d'utiliateur ayant l'identifiant $id_utilisateur"
            );
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('utilisateurs');
    }
}
