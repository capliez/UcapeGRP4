<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var string
     *
     * @ORM\Column(name="ele_nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_date_naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_email_parent", type="string", length=255)
     */
    private $emailParent;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_mdp", type="string", length=255)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire_general", type="text", nullable = true)
     */
    private $commentaireGeneral;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_terre_des_langues", type="boolean", nullable=true)
     */
    private $terreDesLangues;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire_choix", type="text",nullable=true)
     */
    private $commentaireChoix;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_visa_parent", type="boolean",nullable=true)
     */
    private $visaParent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_UE2_date", type="date", nullable=true)
     */
    private $UE2Date;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_UE2_theme_dossier", type="string", length=255, nullable=true)
     */
    private $UE2ThemeDossier;

    /**
     * @var float
     *
     * @ORM\Column(name="ele_UE2_note", type="float", nullable=true)
     */
    private $UE2Note;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_UE2_appreciation", type="text", nullable=true)
     */
    private $UE2Appreciation;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_type", type="string", length=1, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ele_UE1_date", type="date", nullable=true)
     */
    private $UE1Date;

    /**
     * @var float
     *
     * @ORM\Column(name="ele_UE1_note", type="float", nullable=true)
     */
    private $UE1Note;

    /**
     * @var string
     
     * @ORM\Column(name="ele_UE1_Appreciation", type="text", nullable=true)
     */
    private $UE1Appreciation;

    /**
     * @var bool
     *
     * @ORM\Column(name="ele_obtention_diplome", type="boolean", nullable=true)
     */
    private $obtentionDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_mention", type="string", length=255, nullable=true)
     */
    private $mention;

    /**
     * @var string
     *
     * @ORM\Column(name="ele_commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aVoyage;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe", inversedBy="eleves")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Choix", mappedBy="eleve")
     */
    private $choix;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Proposition", mappedBy="eleve")
     */
    private $propositions;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Passer", mappedBy="eleve")
     */
    private $passages;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion", inversedBy="eleves")
     */
    private $promotion;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="eleve", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->choix = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->passages = new ArrayCollection();
    }


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Eleve
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Eleve
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Eleve
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Eleve
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set promo
     *
     * @param integer $promo
     *
     * @return Eleve
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return int
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Eleve
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set emailParent
     *
     * @param string $emailParent
     *
     * @return Eleve
     */
    public function setEmailParent($emailParent)
    {
        $this->emailParent = $emailParent;

        return $this;
    }

    /**
     * Get emailParent
     *
     * @return string
     */
    public function getEmailParent()
    {
        return $this->emailParent;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Eleve
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set commentaireGeneral
     *
     * @param string $commentaireGeneral
     *
     * @return Eleve
     */
    public function setCommentaireGeneral($commentaireGeneral)
    {
        $this->commentaireGeneral = $commentaireGeneral;

        return $this;
    }

    /**
     * Get commentaireGeneral
     *
     * @return string
     */
    public function getCommentaireGeneral()
    {
        return $this->commentaireGeneral;
    }

    /**
     * Set terreDesLangues
     *
     * @param boolean $terreDesLangues
     *
     * @return Eleve
     */
    public function setTerreDesLangues($terreDesLangues)
    {
        $this->terreDesLangues = $terreDesLangues;

        return $this;
    }

    /**
     * Get terreDesLangues
     *
     * @return bool
     */
    public function getTerreDesLangues()
    {
        return $this->terreDesLangues;
    }

    /**
     * Set commentaireChoix
     *
     * @param string $commentaireChoix
     *
     * @return Eleve
     */
    public function setCommentaireChoix($commentaireChoix)
    {
        $this->commentaireChoix = $commentaireChoix;

        return $this;
    }

    /**
     * Get commentaireChoix
     *
     * @return string
     */
    public function getCommentaireChoix()
    {
        return $this->commentaireChoix;
    }

    /**
     * Set visaParent
     *
     * @param boolean $visaParent
     *
     * @return Eleve
     */
    public function setVisaParent($visaParent)
    {
        $this->visaParent = $visaParent;

        return $this;
    }

    /**
     * Get visaParent
     *
     * @return bool
     */
    public function getVisaParent()
    {
        return $this->visaParent;
    }

    /**
     * Set UE2Date
     *
     * @param \DateTime $UE2Date
     *
     * @return Eleve
     */
    public function setUE2Date($UE2Date)
    {
        $this->UE2Date = $UE2Date;

        return $this;
    }

    /**
     * Get UE2Date
     *
     * @return \DateTime
     */
    public function getUE2Date()
    {
        return $this->UE2Date;
    }

    /**
     * Set UE2ThemeDossier
     *
     * @param string $UE2ThemeDossier
     *
     * @return Eleve
     */
    public function setUE2ThemeDossier($UE2ThemeDossier)
    {
        $this->UE2ThemeDossier = $UE2ThemeDossier;

        return $this;
    }

    /**
     * Get UE2ThemeDossier
     *
     * @return string
     */
    public function getUE2ThemeDossier()
    {
        return $this->UE2ThemeDossier;
    }

    /**
     * Set UE2Note
     *
     * @param float $UE2Note
     *
     * @return Eleve
     */
    public function setUE2Note($UE2Note)
    {
        $this->UE2Note = $UE2Note;

        return $this;
    }

    /**
     * Get UE2Note
     *
     * @return float
     */
    public function getUE2Note()
    {
        return $this->UE2Note;
    }

    /**
     * Set UE2Appreciation
     *
     * @param string $UE2Appreciation
     *
     * @return Eleve
     */
    public function setUE2Appreciation($UE2Appreciation)
    {
        $this->UE2Appreciation = $UE2Appreciation;

        return $this;
    }

    /**
     * Get UE2Appreciation
     *
     * @return string
     */
    public function getUE2Appreciation()
    {
        return $this->UE2Appreciation;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Eleve
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set UE1Date
     *
     * @param \DateTime $UE1Date
     *
     * @return Eleve
     */
    public function setUE1Date($UE1Date)
    {
        $this->UE1Date = $UE1Date;

        return $this;
    }

    /**
     * Get UE1Date
     *
     * @return \DateTime
     */
    public function getUE1Date()
    {
        return $this->UE1Date;
    }

    /**
     * Set UE1Note
     *
     * @param float $UE1Note
     *
     * @return Eleve
     */
    public function setUE1Note($UE1Note)
    {
        $this->UE1Note = $UE1Note;

        return $this;
    }

    /**
     * Get UE1Note
     *
     * @return float
     */
    public function getUE1Note()
    {
        return $this->UE1Note;
    }

    /**
     * Set UE1Appreciation
     *
     * @param string $UE1Appreciation
     *
     * @return Eleve
     */
    public function setUE1Appreciation($UE1Appreciation)
    {
        $this->UE1Appreciation = $UE1Appreciation;

        return $this;
    }

    /**
     * Get UE1Appreciation
     *
     * @return string
     */
    public function getUE1Appreciation()
    {
        return $this->UE1Appreciation;
    }

    /**
     * Set obtentionDiplome
     *
     * @param boolean $obtentionDiplome
     *
     * @return Eleve
     */
    public function setObtentionDiplome($obtentionDiplome)
    {
        $this->obtentionDiplome = $obtentionDiplome;

        return $this;
    }

    /**
     * Get obtentionDiplome
     *
     * @return bool
     */
    public function getObtentionDiplome()
    {
        return $this->obtentionDiplome;
    }

    /**
     * Set mention
     *
     * @param string $mention
     *
     * @return Eleve
     */
    public function setMention($mention)
    {
        $this->mention = $mention;

        return $this;
    }

    /**
     * Get mention
     *
     * @return string
     */
    public function getMention()
    {
        return $this->mention;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Eleve
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function getAVoyage()
    {
        return $this->aVoyage;
    }

    public function setAVoyage($aVoyage)
    {
        $this->aVoyage = $aVoyage;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|Choix[]
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Choix $choix): self
    {
        if (!$this->choix->contains($choix)) {
            $this->choix[] = $choix;
            $choix->setEleve($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        if ($this->choix->contains($choix)) {
            $this->choix->removeElement($choix);
            // set the owning side to null (unless already changed)
            if ($choix->getEleve() === $this) {
                $choix->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setEleve($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->contains($proposition)) {
            $this->propositions->removeElement($proposition);
            // set the owning side to null (unless already changed)
            if ($proposition->getEleve() === $this) {
                $proposition->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Passer[]
     */
    public function getPassages(): Collection
    {
        return $this->passages;
    }

    public function addPassage(Passer $passage): self
    {
        if (!$this->passages->contains($passage)) {
            $this->passages[] = $passage;
            $passage->setEleve($this);
        }

        return $this;
    }

    public function removePassage(Passer $passage): self
    {
        if ($this->passages->contains($passage)) {
            $this->passages->removeElement($passage);
            // set the owning side to null (unless already changed)
            if ($passage->getEleve() === $this) {
                $passage->setEleve(null);
            }
        }

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

