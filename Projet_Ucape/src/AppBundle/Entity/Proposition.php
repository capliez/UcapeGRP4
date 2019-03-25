<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropositionRepository")
 */
class Proposition
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
     * @var bool
     *
     * @ORM\Column(name="pro_est_acceptee", type="boolean")
     */
    private $estAcceptee;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_commentaire", type="text")
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pro_date_depart", type="date")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pro_date_fin", type="date")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Eleve", inversedBy="propositions")
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etablissement", inversedBy="propositions")
     */
    private $etablissement;


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
     * Set estAcceptee
     *
     * @param boolean $estAcceptee
     *
     * @return Proposition
     */
    public function setEstAcceptee($estAcceptee)
    {
        $this->estAcceptee = $estAcceptee;

        return $this;
    }

    /**
     * Get estAcceptee
     *
     * @return bool
     */
    public function getEstAcceptee()
    {
        return $this->estAcceptee;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Proposition
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

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Proposition
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Proposition
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}

