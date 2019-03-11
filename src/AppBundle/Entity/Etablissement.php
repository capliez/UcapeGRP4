<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtablissementRepository")
 */
class Etablissement
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
     * @ORM\Column(name="eta_id", type="integer", unique=true)
     */
    private $etaId;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_libelle", type="string", length=255)
     */
    private $etaLibelle;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_nom", type="string", length=255)
     */
    private $etaNom;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_telephone", type="string", length=255, unique=true)
     */
    private $etaTelephone;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_email", type="string", length=255, unique=true)
     */
    private $etaEmail;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_responsable", type="string", length=255)
     */
    private $etaResponsable;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_numero", type="string", length=255, unique=true)
     */
    private $etaNumero;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_rue", type="string", length=255)
     */
    private $etaRue;
    /**
     * @var string
     *
     * @ORM\Column(name="eta_ville", type="string", length=255)
     */
    private $etaVille;
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
     * Set etaId
     *
     * @param integer $etaId
     *
     * @return Etablissement
     */
    public function setEtaId($etaId)
    {
        $this->etaId = $etaId;
        return $this;
    }
    /**
     * Get etaId
     *
     * @return int
     */
    public function getEtaId()
    {
        return $this->etaId;
    }
    /**
     * Set etaLibelle
     *
     * @param string $etaLibelle
     *
     * @return Etablissement
     */
    public function setEtaLibelle($etaLibelle)
    {
        $this->etaLibelle = $etaLibelle;
        return $this;
    }
    /**
     * Get etaLibelle
     *
     * @return string
     */
    public function getEtaLibelle()
    {
        return $this->etaLibelle;
    }
    /**
     * Set etaNom
     *
     * @param string $etaNom
     *
     * @return Etablissement
     */
    public function setEtaNom($etaNom)
    {
        $this->etaNom = $etaNom;
        return $this;
    }
    /**
     * Get etaNom
     *
     * @return string
     */
    public function getEtaNom()
    {
        return $this->etaNom;
    }
    /**
     * Set etaTelephone
     *
     * @param string $etaTelephone
     *
     * @return Etablissement
     */
    public function setEtaTelephone($etaTelephone)
    {
        $this->etaTelephone = $etaTelephone;
        return $this;
    }
    /**
     * Get etaTelephone
     *
     * @return string
     */
    public function getEtaTelephone()
    {
        return $this->etaTelephone;
    }
    /**
     * Set etaEmail
     *
     * @param string $etaEmail
     *
     * @return Etablissement
     */
    public function setEtaEmail($etaEmail)
    {
        $this->etaEmail = $etaEmail;
        return $this;
    }
    /**
     * Get etaEmail
     *
     * @return string
     */
    public function getEtaEmail()
    {
        return $this->etaEmail;
    }
    /**
     * Set etaResponsable
     *
     * @param string $etaResponsable
     *
     * @return Etablissement
     */
    public function setEtaResponsable($etaResponsable)
    {
        $this->etaResponsable = $etaResponsable;
        return $this;
    }
    /**
     * Get etaResponsable
     *
     * @return string
     */
    public function getEtaResponsable()
    {
        return $this->etaResponsable;
    }
    /**
     * Set etaNumero
     *
     * @param string $etaNumero
     *
     * @return Etablissement
     */
    public function setEtaNumero($etaNumero)
    {
        $this->etaNumero = $etaNumero;
        return $this;
    }
    /**
     * Get etaNumero
     *
     * @return string
     */
    public function getEtaNumero()
    {
        return $this->etaNumero;
    }
    /**
     * Set etaRue
     *
     * @param string $etaRue
     *
     * @return Etablissement
     */
    public function setEtaRue($etaRue)
    {
        $this->etaRue = $etaRue;
        return $this;
    }
    /**
     * Get etaRue
     *
     * @return string
     */
    public function getEtaRue()
    {
        return $this->etaRue;
    }
    /**
     * Set etaVille
     *
     * @param string $etaVille
     *
     * @return Etablissement
     */
    public function setEtaVille($etaVille)
    {
        $this->etaVille = $etaVille;
        return $this;
    }
    /**
     * Get etaVille
     *
     * @return string
     */
    public function getEtaVille()
    {
        return $this->etaVille;
    }
}