<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 * @UniqueEntity(fields={"email","matricule","contact","cni"}, message="Cet utilisateur existe déjà")
 */
class Prestataire
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
      * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\NotBlank()
    
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank()
     
     */
    private $nomEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\NotBlank()
     
     */
    private $adresse;

    /**
     * @ORM\Column(type="bigint", unique=true)
     * @Assert\Length(min=9, max=15)
     *  @Assert\NotBlank()
    * //@UniqueEntity(fields={"contact"}, message="Ce numero existe déjà")
     * @Groups({"register"})
     */
    private $contact;

    /**
     * @ORM\Column(type="bigint", unique=true)
     * @Assert\Length(min=12, max=15)
     *  @Assert\NotBlank()
     * //@UniqueEntity(fields={"cni"}, message="Cette cni existe déjà")
     * @Groups({"register"})
     */
    private $cni;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     * //@UniqueEntity(fields={"email"}, message="Cet email existe déjà")
     * @Groups({"register"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * //@UniqueEntity(fields={"matricule"}, message="Cet matricule existe déjà")
     * @Groups({"register"})
     */
    private $matricule;


    /**
     * @ORM\Column(type="bigint", unique=true)
     */
    private $compte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="prestataires")
     */
    private $admin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="proprietaire")
     */
    private $comptes;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *  @Assert\NotBlank()
     *  //@UniqueEntity(fields={"ninea"}, message="Ce ninea existe déjà")
     * @Groups({"register"})
     */
    private $ninea;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserPrestataire", mappedBy="matriculeEntreprise")
     */
    private $userPrestataires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="prestataire")
     */
    private $users;


    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->userPrestataires = new ArrayCollection();
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

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getCompte(): ?int
    {
        return $this->compte;
    }

    public function setCompte(int $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setProprietaire($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getProprietaire() === $this) {
                $compte->setProprietaire(null);
            }
        }

        return $this;
    }

    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(string $ninea): self
    {
        $this->ninea = $ninea;

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
            $userPrestataire->setMatriculeEntreprise($this);
        }

        return $this;
    }

    public function removeUserPrestataire(UserPrestataire $userPrestataire): self
    {
        if ($this->userPrestataires->contains($userPrestataire)) {
            $this->userPrestataires->removeElement($userPrestataire);
            // set the owning side to null (unless already changed)
            if ($userPrestataire->getMatriculeEntreprise() === $this) {
                $userPrestataire->setMatriculeEntreprise(null);
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
            $user->setPrestataire($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getPrestataire() === $this) {
                $user->setPrestataire(null);
            }
        }

        return $this;
    }
}
