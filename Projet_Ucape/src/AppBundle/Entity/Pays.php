<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaysRepository")
 */
class Pays
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
     * @ORM\Column(name="pay_id", type="integer", unique=true)
     */
    private $payId;

    /**
     * @var string
     *
     * @ORM\Column(name="pay_libelle", type="string", length=255, unique=true)
     */
    private $payLibelle;


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
     * Set payId
     *
     * @param integer $payId
     *
     * @return Pays
     */
    public function setPayId($payId)
    {
        $this->payId = $payId;

        return $this;
    }

    /**
     * Get payId
     *
     * @return int
     */
    public function getPayId()
    {
        return $this->payId;
    }

    /**
     * Set payLibelle
     *
     * @param string $payLibelle
     *
     * @return Pays
     */
    public function setPayLibelle($payLibelle)
    {
        $this->payLibelle = $payLibelle;

        return $this;
    }

    /**
     * Get payLibelle
     *
     * @return string
     */
    public function getPayLibelle()
    {
        return $this->payLibelle;
    }
}

