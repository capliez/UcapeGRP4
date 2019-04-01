<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
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
     * @var string
     *
     * @ORM\Column(name="pay_libelle", type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Choix", mappedBy="pays")
     */
    private $choix;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Etablissement", mappedBy="pays")
     */
    private $etablissements;

    public function __construct()
    {
        $this->choix = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
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
     * @return Pays
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
     * @return Collection|Choix[]
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Choix $choix): self
    {
        if (!$this->choix->contains($choix)) {
            $this->choix[] = $choix;
            $choix->setPays($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        if ($this->choix->contains($choix)) {
            $this->choix->removeElement($choix);
            // set the owning side to null (unless already changed)
            if ($choix->getPays() === $this) {
                $choix->setPays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etablissement[]
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements[] = $etablissement;
            $etablissement->setPays($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->contains($etablissement)) {
            $this->etablissements->removeElement($etablissement);
            // set the owning side to null (unless already changed)
            if ($etablissement->getPays() === $this) {
                $etablissement->setPays(null);
            }
        }

        return $this;
    }
}

