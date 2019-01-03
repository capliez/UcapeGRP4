<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eleve
 *
 * @ORM\Table(name="eleve")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EleveRepository")
 */
class Eleve
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ele_id", type="integer", unique=true)
     */
    private $eleId;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_nom", type="string", length=255)
     */
    private $eleNom;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_prenom", type="string", length=255)
     */
    private $elePrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_sexe", type="string", length=255)
     */
    private $eleSexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_date_naissance", type="date")
     */
    private $eleDateNaissance;

    /**
     * @var int
     *
     * @ORM\Column(name="ele_promo", type="integer")
     */
    private $elePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_email", type="string", length=255, unique=true)
     */
    private $eleEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_email_parent", type="string", length=255, unique=true)
     */
    private $eleEmailParent;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_mdp", type="string", length=255)
     */
    private $eleMdp;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire_general", type="text")
     */
    private $eleCommentaireGeneral;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_terre_des_langues", type="boolean")
     */
    private $eleTerreDesLangues;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire_choix", type="text")
     */
    private $eleCommentaireChoix;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_visa_parent", type="boolean")
     */
    private $eleVisaParent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_UE2_date", type="date")
     */
    private $eleUE2Date;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_UE2_theme_dossier", type="string", length=255)
     */
    private $eleUE2ThemeDossier;

    /**
     * @var float
     *
     * @ORM\Column(name="ele_UE2_note", type="float", nullable=true)
     */
    private $eleUE2Note;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_UE2_appreciation", type="text")
     */
    private $eleUE2Appreciation;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_type", type="string", length=1)
     */
    private $eleType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_UE1_date", type="date")
     */
    private $eleUE1Date;

    /**
     * @var float
     *
     * @ORM\Column(name="ele_UE1_note", type="float", nullable=true)
     */
    private $eleUE1Note;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_UE1_Appreciation", type="text", nullable=true)
     */
    private $eleUE1Appreciation;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_obtention_diplome", type="boolean", nullable=true)
     */
    private $eleObtentionDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_mention", type="string", length=255, nullable=true)
     */
    private $eleMention;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire", type="text", nullable=true)
     */
    private $eleCommentaire;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eleId
     *
     * @param integer $eleId
     *
     * @return Eleve
     */
    public function setEleId($eleId)
    {
        $this->eleId = $eleId;

        return $this;
    }

    /**
     * Get eleId
     *
     * @return int
     */
    public function getEleId()
    {
        return $this->eleId;
    }

    /**
     * Set eleNom
     *
     * @param string $eleNom
     *
     * @return Eleve
     */
    public function setEleNom($eleNom)
    {
        $this->eleNom = $eleNom;

        return $this;
    }

    /**
     * Get eleNom
     *
     * @return string
     */
    public function getEleNom()
    {
        return $this->eleNom;
    }

    /**
     * Set elePrenom
     *
     * @param string $elePrenom
     *
     * @return Eleve
     */
    public function setElePrenom($elePrenom)
    {
        $this->elePrenom = $elePrenom;

        return $this;
    }

    /**
     * Get elePrenom
     *
     * @return string
     */
    public function getElePrenom()
    {
        return $this->elePrenom;
    }

    /**
     * Set eleSexe
     *
     * @param string $eleSexe
     *
     * @return Eleve
     */
    public function setEleSexe($eleSexe)
    {
        $this->eleSexe = $eleSexe;

        return $this;
    }

    /**
     * Get eleSexe
     *
     * @return string
     */
    public function getEleSexe()
    {
        return $this->eleSexe;
    }

    /**
     * Set eleDateNaissance
     *
     * @param \DateTime $eleDateNaissance
     *
     * @return Eleve
     */
    public function setEleDateNaissance($eleDateNaissance)
    {
        $this->eleDateNaissance = $eleDateNaissance;

        return $this;
    }

    /**
     * Get eleDateNaissance
     *
     * @return \DateTime
     */
    public function getEleDateNaissance()
    {
        return $this->eleDateNaissance;
    }

    /**
     * Set elePromo
     *
     * @param integer $elePromo
     *
     * @return Eleve
     */
    public function setElePromo($elePromo)
    {
        $this->elePromo = $elePromo;

        return $this;
    }

    /**
     * Get elePromo
     *
     * @return int
     */
    public function getElePromo()
    {
        return $this->elePromo;
    }

    /**
     * Set eleEmail
     *
     * @param string $eleEmail
     *
     * @return Eleve
     */
    public function setEleEmail($eleEmail)
    {
        $this->eleEmail = $eleEmail;

        return $this;
    }

    /**
     * Get eleEmail
     *
     * @return string
     */
    public function getEleEmail()
    {
        return $this->eleEmail;
    }

    /**
     * Set eleEmailParent
     *
     * @param string $eleEmailParent
     *
     * @return Eleve
     */
    public function setEleEmailParent($eleEmailParent)
    {
        $this->eleEmailParent = $eleEmailParent;

        return $this;
    }

    /**
     * Get eleEmailParent
     *
     * @return string
     */
    public function getEleEmailParent()
    {
        return $this->eleEmailParent;
    }

    /**
     * Set eleMdp
     *
     * @param string $eleMdp
     *
     * @return Eleve
     */
    public function setEleMdp($eleMdp)
    {
        $this->eleMdp = $eleMdp;

        return $this;
    }

    /**
     * Get eleMdp
     *
     * @return string
     */
    public function getEleMdp()
    {
        return $this->eleMdp;
    }

    /**
     * Set eleCommentaireGeneral
     *
     * @param string $eleCommentaireGeneral
     *
     * @return Eleve
     */
    public function setEleCommentaireGeneral($eleCommentaireGeneral)
    {
        $this->eleCommentaireGeneral = $eleCommentaireGeneral;

        return $this;
    }

    /**
     * Get eleCommentaireGeneral
     *
     * @return string
     */
    public function getEleCommentaireGeneral()
    {
        return $this->eleCommentaireGeneral;
    }

    /**
     * Set eleTerreDesLangues
     *
     * @param boolean $eleTerreDesLangues
     *
     * @return Eleve
     */
    public function setEleTerreDesLangues($eleTerreDesLangues)
    {
        $this->eleTerreDesLangues = $eleTerreDesLangues;

        return $this;
    }

    /**
     * Get eleTerreDesLangues
     *
     * @return bool
     */
    public function getEleTerreDesLangues()
    {
        return $this->eleTerreDesLangues;
    }

    /**
     * Set eleCommentaireChoix
     *
     * @param string $eleCommentaireChoix
     *
     * @return Eleve
     */
    public function setEleCommentaireChoix($eleCommentaireChoix)
    {
        $this->eleCommentaireChoix = $eleCommentaireChoix;

        return $this;
    }

    /**
     * Get eleCommentaireChoix
     *
     * @return string
     */
    public function getEleCommentaireChoix()
    {
        return $this->eleCommentaireChoix;
    }

    /**
     * Set eleVisaParent
     *
     * @param boolean $eleVisaParent
     *
     * @return Eleve
     */
    public function setEleVisaParent($eleVisaParent)
    {
        $this->eleVisaParent = $eleVisaParent;

        return $this;
    }

    /**
     * Get eleVisaParent
     *
     * @return bool
     */
    public function getEleVisaParent()
    {
        return $this->eleVisaParent;
    }

    /**
     * Set eleUE2Date
     *
     * @param \DateTime $eleUE2Date
     *
     * @return Eleve
     */
    public function setEleUE2Date($eleUE2Date)
    {
        $this->eleUE2Date = $eleUE2Date;

        return $this;
    }

    /**
     * Get eleUE2Date
     *
     * @return \DateTime
     */
    public function getEleUE2Date()
    {
        return $this->eleUE2Date;
    }

    /**
     * Set eleUE2ThemeDossier
     *
     * @param string $eleUE2ThemeDossier
     *
     * @return Eleve
     */
    public function setEleUE2ThemeDossier($eleUE2ThemeDossier)
    {
        $this->eleUE2ThemeDossier = $eleUE2ThemeDossier;

        return $this;
    }

    /**
     * Get eleUE2ThemeDossier
     *
     * @return string
     */
    public function getEleUE2ThemeDossier()
    {
        return $this->eleUE2ThemeDossier;
    }

    /**
     * Set eleUE2Note
     *
     * @param float $eleUE2Note
     *
     * @return Eleve
     */
    public function setEleUE2Note($eleUE2Note)
    {
        $this->eleUE2Note = $eleUE2Note;

        return $this;
    }

    /**
     * Get eleUE2Note
     *
     * @return float
     */
    public function getEleUE2Note()
    {
        return $this->eleUE2Note;
    }

    /**
     * Set eleUE2Appreciation
     *
     * @param string $eleUE2Appreciation
     *
     * @return Eleve
     */
    public function setEleUE2Appreciation($eleUE2Appreciation)
    {
        $this->eleUE2Appreciation = $eleUE2Appreciation;

        return $this;
    }

    /**
     * Get eleUE2Appreciation
     *
     * @return string
     */
    public function getEleUE2Appreciation()
    {
        return $this->eleUE2Appreciation;
    }

    /**
     * Set eleType
     *
     * @param string $eleType
     *
     * @return Eleve
     */
    public function setEleType($eleType)
    {
        $this->eleType = $eleType;

        return $this;
    }

    /**
     * Get eleType
     *
     * @return string
     */
    public function getEleType()
    {
        return $this->eleType;
    }

    /**
     * Set eleUE1Date
     *
     * @param \DateTime $eleUE1Date
     *
     * @return Eleve
     */
    public function setEleUE1Date($eleUE1Date)
    {
        $this->eleUE1Date = $eleUE1Date;

        return $this;
    }

    /**
     * Get eleUE1Date
     *
     * @return \DateTime
     */
    public function getEleUE1Date()
    {
        return $this->eleUE1Date;
    }

    /**
     * Set eleUE1Note
     *
     * @param float $eleUE1Note
     *
     * @return Eleve
     */
    public function setEleUE1Note($eleUE1Note)
    {
        $this->eleUE1Note = $eleUE1Note;

        return $this;
    }

    /**
     * Get eleUE1Note
     *
     * @return float
     */
    public function getEleUE1Note()
    {
        return $this->eleUE1Note;
    }

    /**
     * Set eleUE1Appreciation
     *
     * @param string $eleUE1Appreciation
     *
     * @return Eleve
     */
    public function setEleUE1Appreciation($eleUE1Appreciation)
    {
        $this->eleUE1Appreciation = $eleUE1Appreciation;

        return $this;
    }

    /**
     * Get eleUE1Appreciation
     *
     * @return string
     */
    public function getEleUE1Appreciation()
    {
        return $this->eleUE1Appreciation;
    }

    /**
     * Set eleObtentionDiplome
     *
     * @param boolean $eleObtentionDiplome
     *
     * @return Eleve
     */
    public function setEleObtentionDiplome($eleObtentionDiplome)
    {
        $this->eleObtentionDiplome = $eleObtentionDiplome;

        return $this;
    }

    /**
     * Get eleObtentionDiplome
     *
     * @return bool
     */
    public function getEleObtentionDiplome()
    {
        return $this->eleObtentionDiplome;
    }

    /**
     * Set eleMention
     *
     * @param string $eleMention
     *
     * @return Eleve
     */
    public function setEleMention($eleMention)
    {
        $this->eleMention = $eleMention;

        return $this;
    }

    /**
     * Get eleMention
     *
     * @return string
     */
    public function getEleMention()
    {
        return $this->eleMention;
    }

    /**
     * Set eleCommentaire
     *
     * @param string $eleCommentaire
     *
     * @return Eleve
     */
    public function setEleCommentaire($eleCommentaire)
    {
        $this->eleCommentaire = $eleCommentaire;

        return $this;
    }

    /**
     * Get eleCommentaire
     *
     * @return string
     */
    public function getEleCommentaire()
    {
        return $this->eleCommentaire;
    }
}

