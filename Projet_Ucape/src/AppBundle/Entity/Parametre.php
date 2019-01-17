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
    private $parAnneePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="par_theme_europe_promo", type="string", length=255, unique=true)
     */
    private $parThemeEuropePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="par_chemin_DSP", type="string", length=255, unique=true)
     */
    private $parCheminDSP;


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
     * Set parAnneePromo
     *
     * @param integer $parAnneePromo
     *
     * @return Parametre
     */
    public function setParAnneePromo($parAnneePromo)
    {
        $this->parAnneePromo = $parAnneePromo;

        return $this;
    }

    /**
     * Get parAnneePromo
     *
     * @return int
     */
    public function getParAnneePromo()
    {
        return $this->parAnneePromo;
    }

    /**
     * Set parThemeEuropePromo
     *
     * @param string $parThemeEuropePromo
     *
     * @return Parametre
     */
    public function setParThemeEuropePromo($parThemeEuropePromo)
    {
        $this->parThemeEuropePromo = $parThemeEuropePromo;

        return $this;
    }

    /**
     * Get parThemeEuropePromo
     *
     * @return string
     */
    public function getParThemeEuropePromo()
    {
        return $this->parThemeEuropePromo;
    }

    /**
     * Set parCheminDSP
     *
     * @param string $parCheminDSP
     *
     * @return Parametre
     */
    public function setParCheminDSP($parCheminDSP)
    {
        $this->parCheminDSP = $parCheminDSP;

        return $this;
    }

    /**
     * Get parCheminDSP
     *
     * @return string
     */
    public function getParCheminDSP()
    {
        return $this->parCheminDSP;
    }
}

