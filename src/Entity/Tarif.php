<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @Groups({"transaction"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"tarif"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"tarif"})
     * @ORM\Column(type="bigint")
     */
    private $BI;

    /**
     * @Groups({"transaction"})
     * @Groups({"tarif"})
     * @ORM\Column(type="bigint")
     */
    private $BS;

    /**
     * @Groups({"transaction"})
     * @Groups({"tarif"})
     * @ORM\Column(type="bigint")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="commission")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBI(): ?int
    {
        return $this->BI;
    }

    public function setBI(int $BI): self
    {
        $this->BI = $BI;

        return $this;
    }

    public function getBS(): ?int
    {
        return $this->BS;
    }

    public function setBS(int $BS): self
    {
        $this->BS = $BS;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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
            $transaction->setCommission($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getCommission() === $this) {
                $transaction->setCommission(null);
            }
        }

        return $this;
    }
}
