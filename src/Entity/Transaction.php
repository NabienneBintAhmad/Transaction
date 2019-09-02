<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeTransaction", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $libelle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="bigint")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $envoyeurNomComplet;

    /**
     * @ORM\Column(type="bigint")
     */
    private $envoyeurCni;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recepteurNomComplet;

    /**
     * @ORM\Column(type="bigint")
     */
    private $recepteurCni;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserPrestataire", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $multiservice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarif", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commission;

    /**
     * @ORM\Column(type="bigint")
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?TypeTransaction
    {
        return $this->libelle;
    }

    public function setLibelle(?TypeTransaction $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
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
}
