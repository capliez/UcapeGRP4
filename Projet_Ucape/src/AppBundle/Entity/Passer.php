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
    private $pasDate;

    /**
     * @var float
     *
     * @ORM\Column(name="pas_note", type="float")
     */
    private $pasNote;

    /**
     * @var string
     *
     * @ORM\Column(name="pas_appreciation", type="text")
     */
    private $pasAppreciation;


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
     * Set pasDate
     *
     * @param \DateTime $pasDate
     *
     * @return Passer
     */
    public function setPasDate($pasDate)
    {
        $this->pasDate = $pasDate;

        return $this;
    }

    /**
     * Get pasDate
     *
     * @return \DateTime
     */
    public function getPasDate()
    {
        return $this->pasDate;
    }

    /**
     * Set pasNote
     *
     * @param float $pasNote
     *
     * @return Passer
     */
    public function setPasNote($pasNote)
    {
        $this->pasNote = $pasNote;

        return $this;
    }

    /**
     * Get pasNote
     *
     * @return float
     */
    public function getPasNote()
    {
        return $this->pasNote;
    }

    /**
     * Set pasAppreciation
     *
     * @param string $pasAppreciation
     *
     * @return Passer
     */
    public function setPasAppreciation($pasAppreciation)
    {
        $this->pasAppreciation = $pasAppreciation;

        return $this;
    }

    /**
     * Get pasAppreciation
     *
     * @return string
     */
    public function getPasAppreciation()
    {
        return $this->pasAppreciation;
    }
}

