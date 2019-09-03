<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint", unique=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="bigint")
     */
    private $solde;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="compte")
     */
    private $depots;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserPrestataire", mappedBy="compte")
     */
    private $userPrestataires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="compteTravail")
     */
    private $users;

    public function __construct()
    {
        $this->userPrestataires = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getProprietaire(): ?Prestataire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Prestataire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setCompte($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getCompte() === $this) {
                $depot->setCompte(null);
            }
        }

        return $this;
    }

    

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCompteTravail($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCompteTravail() === $this) {
                $user->setCompteTravail(null);
            }
        }

        return $this;
    }

   
}
