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
     * @var int
     *
     * @ORM\Column(name="lan_id", type="integer", unique=true)
     */
    private $lanId;

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
     * Set lanId
     *
     * @param integer $lanId
     *
     * @return Langue
     */
    public function setLanId($lanId)
    {
        $this->lanId = $lanId;

        return $this;
    }

    /**
     * Get lanId
     *
     * @return int
     */
    public function getLanId()
    {
        return $this->lanId;
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

