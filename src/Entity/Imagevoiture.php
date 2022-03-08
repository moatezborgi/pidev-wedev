<?php

namespace App\Entity;

use App\Repository\ImagevoitureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagevoitureRepository::class)
 */
class Imagevoiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeimagev;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagev;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="imagevoitures")
     */
    private $refvoiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeimagev(): ?string
    {
        return $this->codeimagev;
    }

    public function setCodeimagev(?string $codeimagev): self
    {
        $this->codeimagev = $codeimagev;

        return $this;
    }

    public function getImagev(): ?string
    {
        return $this->imagev;
    }

    public function setImagev(?string $imagev): self
    {
        $this->imagev = $imagev;

        return $this;
    }

    public function getRefvoiture(): ?Voiture
    {
        return $this->refvoiture;
    }

    public function setRefvoiture(?Voiture $refvoiture): self
    {
        $this->refvoiture = $refvoiture;

        return $this;
    }
}
