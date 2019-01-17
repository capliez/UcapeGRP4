<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examinateur
 *
 * @ORM\Table(name="examinateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExaminateurRepository")
 */
class Examinateur
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
     * @ORM\Column(name="exa_id", type="integer", unique=true)
     */
    private $exaId;

    /**
     * @var string
     *
     * @ORM\Column(name="exa_nom", type="string", length=255)
     */
    private $exaNom;

    /**
     * @var string
     *
     * @ORM\Column(name="exa_prenom", type="string", length=255)
     */
    private $exaPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="exa_telephone", type="string", length=255, unique=true)
     */
    private $exaTelephone;


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
     * Set exaId
     *
     * @param integer $exaId
     *
     * @return Examinateur
     */
    public function setExaId($exaId)
    {
        $this->exaId = $exaId;

        return $this;
    }

    /**
     * Get exaId
     *
     * @return int
     */
    public function getExaId()
    {
        return $this->exaId;
    }

    /**
     * Set exaNom
     *
     * @param string $exaNom
     *
     * @return Examinateur
     */
    public function setExaNom($exaNom)
    {
        $this->exaNom = $exaNom;

        return $this;
    }

    /**
     * Get exaNom
     *
     * @return string
     */
    public function getExaNom()
    {
        return $this->exaNom;
    }

    /**
     * Set exaPrenom
     *
     * @param string $exaPrenom
     *
     * @return Examinateur
     */
    public function setExaPrenom($exaPrenom)
    {
        $this->exaPrenom = $exaPrenom;

        return $this;
    }

    /**
     * Get exaPrenom
     *
     * @return string
     */
    public function getExaPrenom()
    {
        return $this->exaPrenom;
    }

    /**
     * Set exaTelephone
     *
     * @param string $exaTelephone
     *
     * @return Examinateur
     */
    public function setExaTelephone($exaTelephone)
    {
        $this->exaTelephone = $exaTelephone;

        return $this;
    }

    /**
     * Get exaTelephone
     *
     * @return string
     */
    public function getExaTelephone()
    {
        return $this->exaTelephone;
    }
}

