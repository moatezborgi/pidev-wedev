<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
  * @ORM\Table(name="menu", indexes={@ORM\Index(name="fk_menu", columns={"refer_resto"})})

 */
class Menu
{ 

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $codmenu;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="descriptione is required")
     */
    private $libPlat;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="prix is required")
     */
    private $prixPlat;

    /**
     * @ORM\Column(type="string", length=255)
 
     */
    private $referResto;
    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="Menu",cascade={"persist"})
     * @ORM\JoinColumn(name="categorie_id",referencedColumnName="id", onDelete="CASCADE")

 
     */
    private $Categorie;

      /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="nom plat is required")
     */
    private $NomPlat;

    public function __construct($referResto)
    {
        $this->referResto =$referResto;
 
    }
    

    public function getCodmenu(): ?int
    {
        return $this->codmenu;
    }

    public function setCodmenu(int $codmenu): self
    {
        $this->codmenu = $codmenu;

        return $this;
    }

    public function getLibPlat(): ?string
    {
        return $this->libPlat;
    }

    public function setLibPlat(string $libPlat): self
    {
        $this->libPlat = $libPlat;

        return $this;
    }

    public function getPrixPlat(): ?float
    {
        return $this->prixPlat;
    }

    public function setPrixPlat(float $prixPlat): self
    {
        $this->prixPlat = $prixPlat;

        return $this;
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
    
    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getNomPlat(): ?string
    {
        return $this->NomPlat;
    }

    public function setNomPlat(string $nomPlat): self
    {
        $this->NomPlat = $nomPlat;

        return $this;
    }
}
