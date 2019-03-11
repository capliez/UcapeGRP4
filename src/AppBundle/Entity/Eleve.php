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
     * @ORM\Column(name="id_eleve", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_eleve", type="string", length=50)
     */
    private $nomEleve;


    /**
     * @ORM\OneToMany(targetEntity="Appartenir", mappedBy="eleves")
     */
    private $appartenir;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_eleve", type="string", length=50)
     */
    private $prenomEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe_eleve", type="string", length=50)
     */
    private $sexeEleve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance_eleve", type="date")
     */
    private $dateNaissanceEleve;

    /**
     * @var int
     *
     * @ORM\Column(name="promo_eleve", type="integer")
     */
    private $promoEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="email_eleve", type="string", length=50)
     */
    private $emailEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="emailParent_eleve", type="string", length=50)
     */
    private $emailParentEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp_eleve", type="string", length=50)
     */
    private $mdpEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaireGeneral_eleve", type="text")
     */
    private $commentaireGeneralEleve;

    /**
     * @var bool
     *
     * @ORM\Column(name="terreDesLangues_eleve", type="boolean")
     */
    private $terreDesLanguesEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaireChoix_eleve", type="text")
     */
    private $commentaireChoixEleve;

    /**
     * @var bool
     *
     * @ORM\Column(name="visaParent_eleve", type="boolean")
     */
    private $visaParentEleve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UE2DATE_eleve", type="date")
     */
    private $uE2DATEEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="UE2ThemeDossier_eleve", type="string", length=50)
     */
    private $uE2ThemeDossierEleve;

    /**
     * @var float
     *
     * @ORM\Column(name="UE2Note_eleve", type="float")
     */
    private $uE2NoteEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="UE2_Appreciations_eleve", type="text")
     */
    private $uE2AppreciationsEleve;


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
     * Set nomEleve
     *
     * @param string $nomEleve
     *
     * @return Eleve
     */
    public function setNomEleve($nomEleve)
    {
        $this->nomEleve = $nomEleve;

        return $this;
    }

    /**
     * Get nomEleve
     *
     * @return string
     */
    public function getNomEleve()
    {
        return $this->nomEleve;
    }

    /**
     * Set prenomEleve
     *
     * @param string $prenomEleve
     *
     * @return Eleve
     */
    public function setPrenomEleve($prenomEleve)
    {
        $this->prenomEleve = $prenomEleve;

        return $this;
    }

    /**
     * Get prenomEleve
     *
     * @return string
     */
    public function getPrenomEleve()
    {
        return $this->prenomEleve;
    }

    /**
     * Set sexeEleve
     *
     * @param string $sexeEleve
     *
     * @return Eleve
     */
    public function setSexeEleve($sexeEleve)
    {
        $this->sexeEleve = $sexeEleve;

        return $this;
    }

    /**
     * Get sexeEleve
     *
     * @return string
     */
    public function getSexeEleve()
    {
        return $this->sexeEleve;
    }

    /**
     * Set dateNaissanceEleve
     *
     * @param \DateTime $dateNaissanceEleve
     *
     * @return Eleve
     */
    public function setDateNaissanceEleve($dateNaissanceEleve)
    {
        $this->dateNaissanceEleve = $dateNaissanceEleve;

        return $this;
    }

    /**
     * Get dateNaissanceEleve
     *
     * @return \DateTime
     */
    public function getDateNaissanceEleve()
    {
        return $this->dateNaissanceEleve;
    }

    /**
     * Set promoEleve
     *
     * @param integer $promoEleve
     *
     * @return Eleve
     */
    public function setPromoEleve($promoEleve)
    {
        $this->promoEleve = $promoEleve;

        return $this;
    }

    /**
     * Get promoEleve
     *
     * @return int
     */
    public function getPromoEleve()
    {
        return $this->promoEleve;
    }

    /**
     * Set emailEleve
     *
     * @param string $emailEleve
     *
     * @return Eleve
     */
    public function setEmailEleve($emailEleve)
    {
        $this->emailEleve = $emailEleve;

        return $this;
    }

    /**
     * Get emailEleve
     *
     * @return string
     */
    public function getEmailEleve()
    {
        return $this->emailEleve;
    }

    /**
     * Set emailParentEleve
     *
     * @param string $emailParentEleve
     *
     * @return Eleve
     */
    public function setEmailParentEleve($emailParentEleve)
    {
        $this->emailParentEleve = $emailParentEleve;

        return $this;
    }

    /**
     * Get emailParentEleve
     *
     * @return string
     */
    public function getEmailParentEleve()
    {
        return $this->emailParentEleve;
    }

    /**
     * Set mdpEleve
     *
     * @param string $mdpEleve
     *
     * @return Eleve
     */
    public function setMdpEleve($mdpEleve)
    {
        $this->mdpEleve = $mdpEleve;

        return $this;
    }

    /**
     * Get mdpEleve
     *
     * @return string
     */
    public function getMdpEleve()
    {
        return $this->mdpEleve;
    }

    /**
     * Set commentaireGeneralEleve
     *
     * @param string $commentaireGeneralEleve
     *
     * @return Eleve
     */
    public function setCommentaireGeneralEleve($commentaireGeneralEleve)
    {
        $this->commentaireGeneralEleve = $commentaireGeneralEleve;

        return $this;
    }

    /**
     * Get commentaireGeneralEleve
     *
     * @return string
     */
    public function getCommentaireGeneralEleve()
    {
        return $this->commentaireGeneralEleve;
    }

    /**
     * Set terreDesLanguesEleve
     *
     * @param boolean $terreDesLanguesEleve
     *
     * @return Eleve
     */
    public function setTerreDesLanguesEleve($terreDesLanguesEleve)
    {
        $this->terreDesLanguesEleve = $terreDesLanguesEleve;

        return $this;
    }

    /**
     * Get terreDesLanguesEleve
     *
     * @return bool
     */
    public function getTerreDesLanguesEleve()
    {
        return $this->terreDesLanguesEleve;
    }

    /**
     * Set commentaireChoixEleve
     *
     * @param string $commentaireChoixEleve
     *
     * @return Eleve
     */
    public function setCommentaireChoixEleve($commentaireChoixEleve)
    {
        $this->commentaireChoixEleve = $commentaireChoixEleve;

        return $this;
    }

    /**
     * Get commentaireChoixEleve
     *
     * @return string
     */
    public function getCommentaireChoixEleve()
    {
        return $this->commentaireChoixEleve;
    }

    /**
     * Set visaParentEleve
     *
     * @param boolean $visaParentEleve
     *
     * @return Eleve
     */
    public function setVisaParentEleve($visaParentEleve)
    {
        $this->visaParentEleve = $visaParentEleve;

        return $this;
    }

    /**
     * Get visaParentEleve
     *
     * @return bool
     */
    public function getVisaParentEleve()
    {
        return $this->visaParentEleve;
    }

    /**
     * Set uE2DATEEleve
     *
     * @param \DateTime $uE2DATEEleve
     *
     * @return Eleve
     */
    public function setUE2DATEEleve($uE2DATEEleve)
    {
        $this->uE2DATEEleve = $uE2DATEEleve;

        return $this;
    }

    /**
     * Get uE2DATEEleve
     *
     * @return \DateTime
     */
    public function getUE2DATEEleve()
    {
        return $this->uE2DATEEleve;
    }

    /**
     * Set uE2ThemeDossierEleve
     *
     * @param string $uE2ThemeDossierEleve
     *
     * @return Eleve
     */
    public function setUE2ThemeDossierEleve($uE2ThemeDossierEleve)
    {
        $this->uE2ThemeDossierEleve = $uE2ThemeDossierEleve;

        return $this;
    }

    /**
     * Get uE2ThemeDossierEleve
     *
     * @return string
     */
    public function getUE2ThemeDossierEleve()
    {
        return $this->uE2ThemeDossierEleve;
    }

    /**
     * Set uE2NoteEleve
     *
     * @param float $uE2NoteEleve
     *
     * @return Eleve
     */
    public function setUE2NoteEleve($uE2NoteEleve)
    {
        $this->uE2NoteEleve = $uE2NoteEleve;

        return $this;
    }

    /**
     * Get uE2NoteEleve
     *
     * @return float
     */
    public function getUE2NoteEleve()
    {
        return $this->uE2NoteEleve;
    }

    /**
     * Set uE2AppreciationsEleve
     *
     * @param string $uE2AppreciationsEleve
     *
     * @return Eleve
     */
    public function setUE2AppreciationsEleve($uE2AppreciationsEleve)
    {
        $this->uE2AppreciationsEleve = $uE2AppreciationsEleve;

        return $this;
    }

    /**
     * Get uE2AppreciationsEleve
     *
     * @return string
     */
    public function getUE2AppreciationsEleve()
    {
        return $this->uE2AppreciationsEleve;
    }

    /**
     * Get idEleve
     *
     * @return integer
     */
    public function getIdEleve()
    {
        return $this->idEleve;
    }

    /**
     * Set appartenir
     *
     * @param \AppBundle\Entity\Appartenir $appartenir
     *
     * @return Eleve
     */
    public function setAppartenir(\AppBundle\Entity\Appartenir $appartenir = null)
    {
        $this->appartenir = $appartenir;

        return $this;
    }

    /**
     * Get appartenir
     *
     * @return \AppBundle\Entity\Appartenir
     */
    public function getAppartenir()
    {
        return $this->appartenir;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appartenir = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add appartenir
     *
     * @param \AppBundle\Entity\Appartenir $appartenir
     *
     * @return Eleve
     */
    public function addAppartenir(\AppBundle\Entity\Appartenir $appartenir)
    {
        $this->appartenir[] = $appartenir;

        return $this;
    }

    /**
     * Remove appartenir
     *
     * @param \AppBundle\Entity\Appartenir $appartenir
     */
    public function removeAppartenir(\AppBundle\Entity\Appartenir $appartenir)
    {
        $this->appartenir->removeElement($appartenir);
    }
}
