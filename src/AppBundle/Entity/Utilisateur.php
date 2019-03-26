<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(name="uti_code", type="integer")
     */
    private $utiCode;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_identifiant", type="string", length=255, unique=true)
     */
    private $utiIdentifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_mot_de_passe", type="string", length=255)
     */
    private $utiMotDePasse;


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
     * Set utiCode
     *
     * @param integer $utiCode
     *
     * @return Utilisateur
     */
    public function setUtiCode($utiCode)
    {
        $this->utiCode = $utiCode;

        return $this;
    }

    /**
     * Get utiCode
     *
     * @return int
     */
    public function getUtiCode()
    {
        return $this->utiCode;
    }

    /**
     * Set utiIdentifiant
     *
     * @param string $utiIdentifiant
     *
     * @return Utilisateur
     */
    public function setUtiIdentifiant($utiIdentifiant)
    {
        $this->utiIdentifiant = $utiIdentifiant;

        return $this;
    }

    /**
     * Get utiIdentifiant
     *
     * @return string
     */
    public function getUtiIdentifiant()
    {
        return $this->utiIdentifiant;
    }

    /**
     * Set utiMotDePasse
     *
     * @param string $utiMotDePasse
     *
     * @return Utilisateur
     */
    public function setUtiMotDePasse($utiMotDePasse)
    {
        $this->utiMotDePasse = $utiMotDePasse;

        return $this;
    }

    /**
     * Get utiMotDePasse
     *
     * @return string
     */
    public function getUtiMotDePasse()
    {
        return $this->utiMotDePasse;
    }
}

