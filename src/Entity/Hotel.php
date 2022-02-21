<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Champ requis")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_hotel", type="string", length=200, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nomHotel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_hotel", type="string", length=200, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $villeHotel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nb_etoile", type="integer", nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nbEtoile;

    /**
     * @ORM\OneToMany(targetEntity=Offrevoyage::class, mappedBy="hotel")
     * 
     */
    private $offrevoyages;

    public function __construct()
    {
        $this->offrevoyages = new ArrayCollection();
    }
 

     
    

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNomHotel(): ?string
    {
        return $this->nomHotel;
    }

    public function setNomHotel(?string $nomHotel): self
    {
        $this->nomHotel = $nomHotel;

        return $this;
    }

    public function getVilleHotel(): ?string
    {
        return $this->villeHotel;
    }

    public function setVilleHotel(?string $villeHotel): self
    {
        $this->villeHotel = $villeHotel;

        return $this;
    }

    public function getNbEtoile(): ?int
    {
        return $this->nbEtoile;
    }

    public function setNbEtoile(?int $nbEtoile): self
    {
        $this->nbEtoile = $nbEtoile;

        return $this;
    }
    public function setId(?string $referHotel): self
    {
        $this->id = $referHotel;
        return $this;

    }

    /**
     * @return Collection|Offrevoyage[]
     */
    public function getOffrevoyages(): Collection
    {
        return $this->offrevoyages;
    }

    public function addOffrevoyage(Offrevoyage $offrevoyage): self
    {
        if (!$this->offrevoyages->contains($offrevoyage)) {
            $this->offrevoyages[] = $offrevoyage;
            $offrevoyage->setHotel($this);
        }

        return $this;
    }

    public function removeOffrevoyage(Offrevoyage $offrevoyage): self
    {
        if ($this->offrevoyages->removeElement($offrevoyage)) {
            // set the owning side to null (unless already changed)
            if ($offrevoyage->getHotel() === $this) {
                $offrevoyage->setHotel(null);
            }
        }

        return $this;
    }
 

   

     
    
    

}
