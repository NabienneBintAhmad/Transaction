<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CaissierRepository")
 *  @UniqueEntity(fields={"email","matricule","contact"}, message="Cet utilisateur existe déjà")
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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="bigint", unique=true)
      * @Assert\NotBlank()
     * @Assert\Length(min=9, max=15)
     */
    private $contact;

    /**
     * @ORM\Column(type="bigint", unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=9, max=15)
     */
    private $cni;

   

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     */
    private $role;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="caissier")
     *  @Assert\NotBlank()
     */
    private $depots;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $authent;

    public function __construct()
    {
        $this->depots = new ArrayCollection();
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
}
