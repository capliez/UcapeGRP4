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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="app_voyage", type="boolean")
     */
    private $voyage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="app_annee", type="date")
     */
    private $annee;


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
     * Set voyage
     *
     * @param boolean $voyage
     *
     * @return Appartenir
     */
    public function setVoyage($voyage)
    {
        $this->voyage = $voyage;

        return $this;
    }

    /**
     * Get voyage
     *
     * @return bool
     */
    public function getVoyage()
    {
        return $this->voyage;
    }

    /**
     * Set annee
     *
     * @param \DateTime $annee
     *
     * @return Appartenir
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return \DateTime
     */
    public function getAnnee()
    {
        return $this->annee;
    }
}

