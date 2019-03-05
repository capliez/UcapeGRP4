<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LangueRepository")
 */
class Langue
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
     * @var string
     *
     * @ORM\Column(name="lan_libelle", type="string", length=255, unique=true)
     */
    private $lanLibelle;


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
     * Set lanLibelle
     *
     * @param string $lanLibelle
     *
     * @return Langue
     */
    public function setLanLibelle($lanLibelle)
    {
        $this->lanLibelle = $lanLibelle;

        return $this;
    }

    /**
     * Get lanLibelle
     *
     * @return string
     */
    public function getLanLibelle()
    {
        return $this->lanLibelle;
    }
}

