<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CaissierRepository")
 */
class Caissier
{
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'Cet email "{{ value }}" n\'est pas valide .',
            'checkMX' => true,
        ]));
    }


    /**
     *  @Groups({"caissier"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $nom;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $prenom;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     */
    private $matricule;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $adresse;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     */
    private $email;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="bigint", unique=true)
      * @Assert\NotBlank()
     * @Assert\Length(min=9, max=15)
     */
    private $contact;

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="bigint", unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=9, max=15)
     */
    private $cni;

   

    /**
     *  @Groups({"caissier"})
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $role;


    /**
     *  @Groups({"caissier"})
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="caissier")
     *  @Assert\NotBlank()
     */
    private $depots;

    /**
     * @Groups({"caissier"})
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $authent;

    /**
     * @Groups({"caissier"})
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="caissier")
     */
    private $users;

    public function __construct()
    {
        $this->depots = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getContact(): ?int
    {
        return $this->contact;
    }

    public function setContact(int $contact): self
    {
        $this->contact = $contact;

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


    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
            $depot->setCaissier($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getCaissier() === $this) {
                $depot->setCaissier(null);
            }
        }

        return $this;
    }

    public function getAuthent(): ?User
    {
        return $this->authent;
    }

    public function setAuthent(User $authent): self
    {
        $this->authent = $authent;

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
            $user->setCaissier($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCaissier() === $this) {
                $user->setCaissier(null);
            }
        }

        return $this;
    }
}
