<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Passer
 *
 * @ORM\Table(name="passer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PasserRepository")
 */
class Passer
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
     * @var \DateTime
     *
     * @ORM\Column(name="pas_date", type="date")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="pas_note", type="float")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="pas_appreciation", type="text")
     */
    private $appreciation;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Langue")
     */
    private $langue;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Eleve", inversedBy="passages")
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Examinateur")
     */
    private $examinateur;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Passer
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return Passer
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set appreciation
     *
     * @param string $appreciation
     *
     * @return Passer
     */
    public function setAppreciation($appreciation)
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    /**
     * Get appreciation
     *
     * @return string
     */
    public function getAppreciation()
    {
        return $this->appreciation;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getExaminateur(): ?Examinateur
    {
        return $this->examinateur;
    }

    public function setExaminateur(?Examinateur $examinateur): self
    {
        $this->examinateur = $examinateur;

        return $this;
    }
}

