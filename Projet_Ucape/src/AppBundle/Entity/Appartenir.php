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
    private $appVoyage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="app_annee", type="date")
     */
    private $appAnnee;


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
     * Set appVoyage
     *
     * @param boolean $appVoyage
     *
     * @return Appartenir
     */
    public function setAppVoyage($appVoyage)
    {
        $this->appVoyage = $appVoyage;

        return $this;
    }

    /**
     * Get appVoyage
     *
     * @return bool
     */
    public function getAppVoyage()
    {
        return $this->appVoyage;
    }

    /**
     * Set appAnnee
     *
     * @param \DateTime $appAnnee
     *
     * @return Appartenir
     */
    public function setAppAnnee($appAnnee)
    {
        $this->appAnnee = $appAnnee;

        return $this;
    }

    /**
     * Get appAnnee
     *
     * @return \DateTime
     */
    public function getAppAnnee()
    {
        return $this->appAnnee;
    }
}

