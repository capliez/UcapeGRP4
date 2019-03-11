<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_classe", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Appartenir", mappedBy="classes")
     */
    private $appartenir;


    /**
     * @var string
     *
     * @ORM\Column(name="libelle_classe", type="string", length=50)
     */
    private $libelleClasse;


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
     * Set libelleClasse
     *
     * @param string $libelleClasse
     *
     * @return Classe
     */
    public function setLibelleClasse($libelleClasse)
    {
        $this->libelleClasse = $libelleClasse;

        return $this;
    }

    /**
     * Get libelleClasse
     *
     * @return string
     */
    public function getLibelleClasse()
    {
        return $this->libelleClasse;
    }

    /**
     * Get idClasse
     *
     * @return integer
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * Set appartenir
     *
     * @param \AppBundle\Entity\Appartenir $appartenir
     *
     * @return Classe
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
     * @return Classe
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
