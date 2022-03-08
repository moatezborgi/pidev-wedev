<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="description is required")
     */
    private $libCat;

    /**
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="Categorie",cascade={"remove"})
 
     
     */
    private $Restaurant;
  /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="Categorie",cascade={"remove"})
     */
    private $Menu;
    public function __construct()
    {
        $this->Restaurant = new ArrayCollection();
        $this->Menu = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCat(): ?string
    {
        return $this->libCat;
    }

    public function setLibCat(string $libCat): self
    {
        $this->libCat = $libCat;

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getRestaurant(): Collection
    {
        return $this->Restaurant;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->Restaurant->contains($restaurant)) {
            $this->Restaurant[] = $restaurant;
            $restaurant->setCategorie($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->Restaurant->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getCategorie() === $this) {
                $restaurant->setCategorie(null);
            }
        }

        return $this;
    }

 /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->Menu;
    }

    public function addMenu(Menu $Menu): self
    {
        if (!$this->Menu->contains($Menu)) {
            $this->Menu[] = $Menu;
            $Menu->setCategorie($this);
        }

        return $this;
    }

    public function removeMeny(Menu $Menu): self
    {
        if ($this->Menu->removeElement($Menu)) {
            // set the owning side to null (unless already changed)
            if ($Menu->getCategorie() === $this) {
                $Menu->setCategorie(null);
            }
        }

        return $this;
    }


}
