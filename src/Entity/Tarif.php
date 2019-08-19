<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $BI;

    /**
     * @ORM\Column(type="bigint")
     */
    private $BS;

    /**
     * @ORM\Column(type="bigint")
     */
    private $prix;

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
}
