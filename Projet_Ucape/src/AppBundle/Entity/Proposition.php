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
    private $proEstAcceptee;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_commentaire", type="text")
     */
    private $proCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pro_date_depart", type="date")
     */
    private $proDateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pro_date_fin", type="date")
     */
    private $proDateFin;


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
     * Set proEstAcceptee
     *
     * @param boolean $proEstAcceptee
     *
     * @return Proposition
     */
    public function setProEstAcceptee($proEstAcceptee)
    {
        $this->proEstAcceptee = $proEstAcceptee;

        return $this;
    }

    /**
     * Get proEstAcceptee
     *
     * @return bool
     */
    public function getProEstAcceptee()
    {
        return $this->proEstAcceptee;
    }

    /**
     * Set proCommentaire
     *
     * @param string $proCommentaire
     *
     * @return Proposition
     */
    public function setProCommentaire($proCommentaire)
    {
        $this->proCommentaire = $proCommentaire;

        return $this;
    }

    /**
     * Get proCommentaire
     *
     * @return string
     */
    public function getProCommentaire()
    {
        return $this->proCommentaire;
    }

    /**
     * Set proDateDepart
     *
     * @param \DateTime $proDateDepart
     *
     * @return Proposition
     */
    public function setProDateDepart($proDateDepart)
    {
        $this->proDateDepart = $proDateDepart;

        return $this;
    }

    /**
     * Get proDateDepart
     *
     * @return \DateTime
     */
    public function getProDateDepart()
    {
        return $this->proDateDepart;
    }

    /**
     * Set proDateFin
     *
     * @param \DateTime $proDateFin
     *
     * @return Proposition
     */
    public function setProDateFin($proDateFin)
    {
        $this->proDateFin = $proDateFin;

        return $this;
    }

    /**
     * Get proDateFin
     *
     * @return \DateTime
     */
    public function getProDateFin()
    {
        return $this->proDateFin;
    }
}

