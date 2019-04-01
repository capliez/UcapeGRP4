<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue")
 * @ORM\Entity
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examinateur", mappedBy="langue")
     */
    private $examinateurs;

    public function __construct()
    {
        $this->examinateurs = new ArrayCollection();
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
     * @return Langue
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
     * @return Collection|Examinateur[]
     */
    public function getExaminateurs(): Collection
    {
        return $this->examinateurs;
    }

    public function addExaminateur(Examinateur $examinateur): self
    {
        if (!$this->examinateurs->contains($examinateur)) {
            $this->examinateurs[] = $examinateur;
            $examinateur->setLangue($this);
        }

        return $this;
    }

    public function removeExaminateur(Examinateur $examinateur): self
    {
        if ($this->examinateurs->contains($examinateur)) {
            $this->examinateurs->removeElement($examinateur);
            // set the owning side to null (unless already changed)
            if ($examinateur->getLangue() === $this) {
                $examinateur->setLangue(null);
            }
        }

        return $this;
    }
}

