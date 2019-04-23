<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Eleve", mappedBy="user", cascade={"persist", "remove"})
     */
    private $eleve;
    

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $eleve === null ? null : $this;
        if ($newUser !== $eleve->getUser()) {
            $eleve->setUser($newUser);
        }

        return $this;
    }

}
