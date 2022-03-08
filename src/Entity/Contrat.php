<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateretour;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contrats")
     */
    private $voiturealouer;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixLocation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->Datedebut;
    }

    public function setDatedebut(\DateTimeInterface $Datedebut): self
    {
        $this->Datedebut = $Datedebut;

        return $this;
    }

    public function getDateretour(): ?\DateTimeInterface
    {
        return $this->dateretour;
    }

    public function setDateretour(\DateTimeInterface $dateretour): self
    {
        $this->dateretour = $dateretour;

        return $this;
    }

    public function getVoiturealouer(): ?Voiture
    {
        return $this->voiturealouer;
    }

    public function setVoiturealouer(?Voiture $voiturealouer): self
    {
        $this->voiturealouer = $voiturealouer;

        return $this;
    }

    public function getPrixLocation(): ?float
    {
        return $this->PrixLocation;
    }

    public function setPrixLocation(?float $PrixLocation): self
    {
        $this->PrixLocation = $PrixLocation;

        return $this;
    }
    public function __toString()
    {
        return(string)$this->getPrixLocation();
    }
}
