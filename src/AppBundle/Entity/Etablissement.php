<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity
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
     * @var string
     *
     * @ORM\Column(name="eta_libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_telephone", type="string", length=255, unique=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_responsable", type="string", length=255)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_numero", type="string", length=255, unique=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_rue", type="string", length=255)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_ville", type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pays", inversedBy="etablissements")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Proposition", mappedBy="etablissement")
     */
    private $propositions;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
    }



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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Etablissement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etablissement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Etablissement
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Etablissement
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Etablissement
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Etablissement
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Etablissement
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Etablissement
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setEtablissement($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->contains($proposition)) {
            $this->propositions->removeElement($proposition);
            // set the owning side to null (unless already changed)
            if ($proposition->getEtablissement() === $this) {
                $proposition->setEtablissement(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}

