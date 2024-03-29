<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserPrestataireRepository")
 */
class UserPrestataire 
{
    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="userPrestataires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matriculeEntreprise;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="bigint")
     */
    private $contact;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\Column(type="bigint")
     */
    private $cni;

    /**
     *  @Groups({"userpresta"})
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $authent;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @Groups({"retrait"})
     * @Groups({"envoie"})
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="serviceRetrait")
     */
    private $transactions;

    /**
     * @Groups({"transaction"})
     * @Groups({"userpresta"})
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="userpresta")
     */
    private $users;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->users = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeEntreprise(): ?Prestataire
    {
        return $this->matriculeEntreprise;
    }

    public function setMatriculeEntreprise(?Prestataire $matriculeEntreprise): self
    {
        $this->matriculeEntreprise = $matriculeEntreprise;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getContact(): ?int
    {
        return $this->contact;
    }

    public function setContact(int $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCni(): ?int
    {
        return $this->cni;
    }

    public function setCni(int $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getAuthent(): ?User
    {
        return $this->authent;
    }

    public function setAuthent(?User $authent): self
    {
        $this->authent = $authent;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setServiceRetrait($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getServiceRetrait() === $this) {
                $transaction->setServiceRetrait(null);
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
            $user->setUserpresta($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getUserpresta() === $this) {
                $user->setUserpresta(null);
            }
        }

        return $this;
    }


  
}
