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

    public function __construct()
    {
        $this->userPrestataires = new ArrayCollection();
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
     * @return Collection|UserPrestataire[]
     */
    public function getUserPrestataires(): Collection
    {
        return $this->userPrestataires;
    }

    public function addUserPrestataire(UserPrestataire $userPrestataire): self
    {
        if (!$this->userPrestataires->contains($userPrestataire)) {
            $this->userPrestataires[] = $userPrestataire;
            $userPrestataire->setCompte($this);
        }

        return $this;
    }

    public function removeUserPrestataire(UserPrestataire $userPrestataire): self
    {
        if ($this->userPrestataires->contains($userPrestataire)) {
            $this->userPrestataires->removeElement($userPrestataire);
            // set the owning side to null (unless already changed)
            if ($userPrestataire->getCompte() === $this) {
                $userPrestataire->setCompte(null);
            }
        }

        return $this;
    }

   
}
