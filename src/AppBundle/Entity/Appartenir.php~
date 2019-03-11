<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appartenir
 *
 * @ORM\Table(name="appartenir")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppartenirRepository")
 */
class Appartenir
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_appartenir", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="appartenir")
     * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id")
     */
    private $eleves;

    /**
     * @ORM\ManyToOne(targetEntity="Annee", inversedBy="appartenir")
     * @ORM\JoinColumn(name="annee_id", referencedColumnName="id")
     */
    private $annees;

    /**
     * @ORM\ManyToOne(targetEntity="Classe", inversedBy="appartenir")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classes;

    /**
     * @var bool
     *
     * @ORM\Column(name="a_voyage_appartenir", type="boolean")
     */
    private $aVoyageAppartenir;


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
     * Set aVoyageAppartenir
     *
     * @param boolean $aVoyageAppartenir
     *
     * @return Appartenir
     */
    public function setAVoyageAppartenir($aVoyageAppartenir)
    {
        $this->aVoyageAppartenir = $aVoyageAppartenir;

        return $this;
    }

    /**
     * Get aVoyageAppartenir
     *
     * @return bool
     */
    public function getAVoyageAppartenir()
    {
        return $this->aVoyageAppartenir;
    }

    /**
     * Get idAppartenir
     *
     * @return integer
     */
    public function getIdAppartenir()
    {
        return $this->idAppartenir;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eleves = new \Doctrine\Common\Collections\ArrayCollection();
        $this->annees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add elefe
     *
     * @param \AppBundle\Entity\Eleve $elefe
     *
     * @return Appartenir
     */
    public function addElefe(\AppBundle\Entity\Eleve $elefe)
    {
        $this->eleves[] = $elefe;

        return $this;
    }

    /**
     * Remove elefe
     *
     * @param \AppBundle\Entity\Eleve $elefe
     */
    public function removeElefe(\AppBundle\Entity\Eleve $elefe)
    {
        $this->eleves->removeElement($elefe);
    }

    /**
     * Get eleves
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * Add annee
     *
     * @param \AppBundle\Entity\Annee $annee
     *
     * @return Appartenir
     */
    public function addAnnee(\AppBundle\Entity\Annee $annee)
    {
        $this->annees[] = $annee;

        return $this;
    }

    /**
     * Remove annee
     *
     * @param \AppBundle\Entity\Annee $annee
     */
    public function removeAnnee(\AppBundle\Entity\Annee $annee)
    {
        $this->annees->removeElement($annee);
    }

    /**
     * Get annees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnees()
    {
        return $this->annees;
    }

    /**
     * Add class
     *
     * @param \AppBundle\Entity\Classe $class
     *
     * @return Appartenir
     */
    public function addClass(\AppBundle\Entity\Classe $class)
    {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \AppBundle\Entity\Classe $class
     */
    public function removeClass(\AppBundle\Entity\Classe $class)
    {
        $this->classes->removeElement($class);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasses()
    {
        return $this->classes;
    }
}
