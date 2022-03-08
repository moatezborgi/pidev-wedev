<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
 

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
   
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank(message="reference is required")
     */
    private $referResto;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="nom du restaurant is required")
     */
    private $nomResto;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank(message="adresse is required")
     */
    private $adresseResto;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank(message="telephone is required")
     *  @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Le numéro doit avoir au minimum {{ limit }} caractères"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="nombre d'etoile is required")
     */
    private $nbEtoile;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="Restaurant")
     * @Assert\NotBlank(message="categorie is required")
     */
    private $Categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferResto(): ?string
    {
        return $this->referResto;
    }

    public function setReferResto(string $referResto): self
    {
        $this->referResto = $referResto;

        return $this;
    }

    public function getNomResto(): ?string
    {
        return $this->nomResto;
    }

    public function setNomResto(string $nomResto): self
    {
        $this->nomResto = $nomResto;

        return $this;
    }

    public function getAdresseResto(): ?string
    {
        return $this->adresseResto;
    }

    public function setAdresseResto(string $adresseResto): self
    {
        $this->adresseResto = $adresseResto;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNbEtoile(): ?string
    {
        return $this->nbEtoile;
    }

    public function setNbEtoile(string $nbEtoile): self
    {
        $this->nbEtoile = $nbEtoile;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }
}
