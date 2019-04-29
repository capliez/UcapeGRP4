<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Classe;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Etablissement;
use AppBundle\Entity\Examinateur;
use AppBundle\Entity\Langue;
use AppBundle\Entity\User;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Proposition;

class UcapeFixtures implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $faker = \Faker\Factory::create('fr_FR');

        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('technicien@lyceestvincent.fr');
        $admin->setPlainPassword('admin');
        $admin->setEnabled(true);
        $admin->setRoles(array('ROLE_ADMIN'));

        $userManager->updateUser($admin, true);

        $consultant = $userManager->createUser();
        $consultant->setUsername('consultant');
        $consultant->setEmail('consultant@yahoo.fr');
        $consultant->setPlainPassword('consultant');
        $consultant->setEnabled(true);
        $consultant->setRoles(array('ROLE_CONSULTANT'));

        $userManager->updateUser($consultant, true);

        // $user = $userManager->createUser();
        // $user->setUsername('capliez');
        // $user->setEmail('capliezalexis@yahoo.fr');
        // $user->setPlainPassword('alexis');
        // $user->setEnabled(true);
        // $user->setRoles(array('ROLE_ELEVE'));

        // $userManager->updateUser($user, true);

        $arrayAttributionPays = [];
        $arrayLangue = ["Angleterre","Espagne","Allemagne", "Italie","Pays-Bas","Canada", "Autriche", "Mexique"];
        for ($l=0;$l <8; $l++) {
            $pays = new Pays();
            $pays->setLibelle($faker->country());
            $arrayAttributionPays[$l+1] = $pays;

            $manager->persist($pays);
        }

        // for ($x=0; $x<50;$x++) {

        //     $userRandom = new User();
        //     $userRandom->setUsername();;
        //     $userRandom->setEmail($faker->email());
        //     $userRandom->setPlainPassword($faker->password());
        //     $userRandom->setEnabled($faker->boolean());

        //     $manager->persist($userRandom);
        // }

        $arrayAttributionClasse = [];
        $arrayClasse = ["2nde 3", "2nde 2", "2nde 1", "1ère 3", "1ère 2", "1ère 1", "T S", "T ES", "T STMG", "T L"];
        for ($j = 0; $j < 10 ; $j++) {
            $classe = new Classe();
            $classe->setLibelle($arrayClasse[$j]);
            $manager->persist($classe);
            $arrayAttributionClasse[$j+1] = $classe;
        }

        $arrayPromo = [];
        $arrayPromotion = ["2013","2014","2015"];
        for ($j = 0; $j < 3 ; $j++) {
            $promo = new Promotion();
            $promo->setAnnee($arrayPromotion[$j]);
            $manager->persist($promo);
            $arrayPromo[$j+1] = $promo;
        }
        for ($l=0;$l <50; $l++)
        {
            $eleve = new Eleve();
            $eleve->setNom($faker->lastName());
            $eleve->setPrenom($faker->firstName());
            $eleve->setSexe($faker->randomElement($array = array ('g','f')));
            $eleve->setDateNaissance($faker->dateTime());
            //$eleve->setPromo($faker->year($max = 'now'));
            $eleve->setEmail($faker->email());
            $eleve->setEmailParent($faker->email());
            $eleve->setCommentaireGeneral($faker->text($maxNbChars=60));
            $eleve->setTerreDesLangues($faker->boolean());
            $eleve->setCommentaireChoix($faker->text($maxNbChars=50));
            $eleve->setVisaParent($faker->boolean());
            $eleve->setUE2Date($faker->dateTime());
            $eleve->setUE2ThemeDossier($faker->catchPhrase());
            $eleve->setUE2Note($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 20));
            $eleve->setUE2Appreciation($faker->word());
            $eleve->setType($faker->boolean());
            $eleve->setClasse($arrayAttributionClasse[rand(1,9)]);
            $eleve->setPromotion($arrayPromo[rand(1,3)]);
            $manager->persist($eleve);

            $user = $userManager->createUser();
            $user->setUsername($eleve->getNom().$eleve->getPrenom());
            $user->setEmail($eleve->getEmail());
            $user->setPlainPassword($eleve->getNom());
            $user->setEnabled(true);
            $user->setRoles(array('ROLE_ELEVE'));

            $userManager->updateUser($user, true);

            $eleve->setUser($user);

            if ($eleve->getType() == true)
            {
                $eleve->setUE1Date($faker->dateTime());
                $eleve->setUE1Note($faker->numberBetween($min = 0, $max = 20));
                $eleve->setUE1Appreciation($faker->randomElement($array = array ('Bon travail, peut être amélioré','Elève concerné, apprentissage à consolider','Très bon élève, des résultats excellents','Elève dissipé, manque de connaissance, resaisissez-vous','Elève nul')));
                $eleve->setObtentionDiplome($faker->boolean());
                $eleve->setMention($faker->randomElement($array = array ('Bien','Très bien','Excellent')));
                $eleve->setCommentaire($faker->text());
            }
        }
        for ($i = 0; $i < 10 ; $i++) {
            $etablissement = new Etablissement();
            $etablissement->setLibelle($faker->company());
            $etablissement->setNom($faker->company());
            $etablissement->setTelephone($faker->e164PhoneNumber());
            $etablissement->setEmail($faker->email());
            $etablissement->setResponsable($faker->name());
            $etablissement->setNumero($faker->numberBetween($min=0, $max=100));
            $etablissement->setRue($faker->numberBetween($min=0, $max=100));
            $etablissement->setVille($faker->city());
            $etablissement->setPays($arrayAttributionPays[rand(1,8)]);
            $manager->persist($etablissement);
        }

        $arrayAttributionLangue = [];
        $arrayLangue = ["Anglais","Espagnol","Allemand", "Italien","Néerlandais"];
        for ($j = 0; $j < 5 ; $j++) {
            $langue = new Langue();
            $langue->setLibelle($arrayLangue[$j]);
            $arrayAttributionLangue[$j+1] = $langue;

            $manager->persist($langue);
        }

        for ($j = 0; $j < 10 ; $j++) {
            $examinateur = new Examinateur();
            $examinateur->setNom($faker->lastName());
            $examinateur->setPrenom($faker->firstName());
            $examinateur->setTelephone($faker->e164PhoneNumber());
            $examinateur->setLangue($arrayAttributionLangue[rand(1,5)]);

            $manager->persist($examinateur);
        }

        $manager->flush();
    }
}