<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
      * @Groups({"transaction"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
   
     * @Groups({"envoie"})
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @Groups({"retrait"})
     * @Groups({"envoie"})
     * @ORM\Column(type="bigint")
     */
    private $montant;

    /**
     *  * @Groups({"retrait"})
     * @Groups({"envoie"})
     * @ORM\Column(type="string", length=255)
     */
    private $envoyeurNomComplet;

    /**
     * @Groups({"envoie"})
     * @ORM\Column(type="bigint")
     */
    private $envoyeurCni;

    /**
     * @Groups({"retrait"})
     * @Groups({"envoie"})
     * @ORM\Column(type="string", length=255)
     */
    private $recepteurNomComplet;

    /**
     * @Groups({"retrait"})
     * @ORM\Column(type="bigint" , nullable=true)
     */
    private $recepteurCni;

    /**
     * @Groups({"envoie"})
     * @ORM\ManyToOne(targetEntity="App\Entity\UserPrestataire", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $multiservice;

    /**
     * @Groups({"tarif"})
     * @Groups({"retrait"})
     * @Groups({"envoie"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarif", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commission;

    /**
     * @Groups({"envoie"})
     * @ORM\Column(type="bigint")
     */
    private $code;

    /**
     * @Groups({"transaction"})
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @Groups({"retrait"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRetrait;

    /**
     * @Groups({"transaction"})
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @Groups({"retrait"})
     * @ORM\ManyToOne(targetEntity="App\Entity\UserPrestataire", inversedBy="transactions")
     *  @ORM\JoinColumn(nullable=true)
     */
    private $serviceRetrait;

    /**
     *@Groups({"envoie"})
     * @ORM\Column(type="bigint")
     */
    private $comEnv;

    /**
     * @Groups({"retrait"})
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $comRet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adminEnv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="transactions")
     */
    private $adminRet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getEnvoyeurNomComplet(): ?string
    {
        return $this->envoyeurNomComplet;
    }

    public function setEnvoyeurNomComplet(string $envoyeurNomComplet): self
    {
        $this->envoyeurNomComplet = $envoyeurNomComplet;

        return $this;
    }

    public function getEnvoyeurCni(): ?int
    {
        return $this->envoyeurCni;
    }

    public function setEnvoyeurCni(int $envoyeurCni): self
    {
        $this->envoyeurCni = $envoyeurCni;

        return $this;
    }

    public function getRecepteurNomComplet(): ?string
    {
        return $this->recepteurNomComplet;
    }

    public function setRecepteurNomComplet(string $recepteurNomComplet): self
    {
        $this->recepteurNomComplet = $recepteurNomComplet;

        return $this;
    }

    public function getRecepteurCni(): ?int
    {
        return $this->recepteurCni;
    }

    public function setRecepteurCni(int $recepteurCni): self
    {
        $this->recepteurCni = $recepteurCni;

        return $this;
    }

    public function getMultiservice(): ?UserPrestataire
    {
        return $this->multiservice;
    }

    public function setMultiservice(?UserPrestataire $multiservice): self
    {
        $this->multiservice = $multiservice;

        return $this;
    }

    public function getCommission(): ?Tarif
    {
        return $this->commission;
    }

    public function setCommission(?Tarif $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(?\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getServiceRetrait(): ?UserPrestataire
    {
        return $this->serviceRetrait;
    }

    public function setServiceRetrait(?UserPrestataire $serviceRetrait): self
    {
        $this->serviceRetrait = $serviceRetrait;

        return $this;
    }

    public function getComEnv(): ?int
    {
        return $this->comEnv;
    }

    public function setComEnv(int $comEnv): self
    {
        $this->comEnv = $comEnv;

        return $this;
    }

    public function getComRet(): ?int
    {
        return $this->comRet;
    }

    public function setComRet(?int $comRet): self
    {
        $this->comRet = $comRet;

        return $this;
    }

    public function getAdminEnv(): ?Admin
    {
        return $this->adminEnv;
    }

    public function setAdminEnv(?Admin $adminEnv): self
    {
        $this->adminEnv = $adminEnv;

        return $this;
    }

    public function getAdminRet(): ?Admin
    {
        return $this->adminRet;
    }

    public function setAdminRet(?Admin $adminRet): self
    {
        $this->adminRet = $adminRet;

        return $this;
    }
}
