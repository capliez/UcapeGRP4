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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cla_id", type="integer", unique=true)
     */
    private $claId;

    /**
     * @var string
     *
     * @ORM\Column(name="cla_libelle", type="string", length=255, unique=true)
     */
    private $claLibelle;


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
     * Set claId
     *
     * @param integer $claId
     *
     * @return Classe
     */
    public function setClaId($claId)
    {
        $this->claId = $claId;

        return $this;
    }

    /**
     * Get claId
     *
     * @return int
     */
    public function getClaId()
    {
        return $this->claId;
    }

    /**
     * Set claLibelle
     *
     * @param string $claLibelle
     *
     * @return Classe
     */
    public function setClaLibelle($claLibelle)
    {
        $this->claLibelle = $claLibelle;

        return $this;
    }

    /**
     * Get claLibelle
     *
     * @return string
     */
    public function getClaLibelle()
    {
        return $this->claLibelle;
    }
}

