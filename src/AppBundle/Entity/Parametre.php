<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table(name="parametre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametreRepository")
 */
class Parametre
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
     * @ORM\Column(name="par_annee_promo", type="integer", unique=true)
     */
    private $anneePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="par_theme_europe_promo", type="string", length=255, unique=true)
     */
    private $themeEuropePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="par_chemin_DSP", type="string", length=255, unique=true)
     */
    private $cheminDSP;


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
     * Set anneePromo
     *
     * @param integer $anneePromo
     *
     * @return Parametre
     */
    public function setAnneePromo($anneePromo)
    {
        $this->anneePromo = $anneePromo;

        return $this;
    }

    /**
     * Get anneePromo
     *
     * @return int
     */
    public function getAnneePromo()
    {
        return $this->anneePromo;
    }

    /**
     * Set themeEuropePromo
     *
     * @param string $themeEuropePromo
     *
     * @return Parametre
     */
    public function setThemeEuropePromo($themeEuropePromo)
    {
        $this->themeEuropePromo = $themeEuropePromo;

        return $this;
    }

    /**
     * Get themeEuropePromo
     *
     * @return string
     */
    public function getThemeEuropePromo()
    {
        return $this->themeEuropePromo;
    }

    /**
     * Set cheminDSP
     *
     * @param string $cheminDSP
     *
     * @return Parametre
     */
    public function setCheminDSP($cheminDSP)
    {
        $this->cheminDSP = $cheminDSP;

        return $this;
    }

    /**
     * Get cheminDSP
     *
     * @return string
     */
    public function getCheminDSP()
    {
        return $this->cheminDSP;
    }
}

