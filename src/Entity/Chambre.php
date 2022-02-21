<?php
 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chambre
 *
 * @ORM\Table(name="chambre", indexes={@ORM\Index(name="fk_chambre", columns={"refer_hotel"})})
 * @ORM\Entity
 */
class Chambre
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_chambre", type="integer", nullable=false)
     * @ORM\Id
     *@Assert\NotBlank(message="Champ requis")
      */
    private $numChambre;

 
    /**
     * @var string|null
     *
     * @ORM\Column(name="type_chambre", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $typeChambre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nb_lit", type="integer", nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nbLit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disponibilite", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $disponibilite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vue_chambre", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $vueChambre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refer_hotel", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $referHotel;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_nuit", type="float", nullable=false)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $prixNuit;
 
    public function getNumChambre(): ?int
    {
        return $this->numChambre;
    }


    public function setNumChambre(?string $numChambre): self
    {
        $this->numChambre = $numChambre;

        return $this;
    }



    public function getTypeChambre(): ?string
    {
        return $this->typeChambre;
    }

    public function setTypeChambre(?string $typeChambre): self
    {
        $this->typeChambre = $typeChambre;

        return $this;
    }

    public function getNbLit(): ?int
    {
        return $this->nbLit;
    }

    public function setNbLit(?int $nbLit): self
    {
        $this->nbLit = $nbLit;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(?string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getVueChambre(): ?string
    {
        return $this->vueChambre;
    }

    public function setVueChambre(?string $vueChambre): self
    {
        $this->vueChambre = $vueChambre;

        return $this;
    }

    public function getReferHotel(): ?string
    {
        return $this->referHotel;
    }

    public function setReferHotel(?string $referHotel): self
    {
        $this->referHotel = $referHotel;

        return $this;
    }

    public function getPrixNuit(): ?string
    {
        return $this->prixNuit;
    }

    public function setPrixNuit(string $prixNuit): self
    {
        $this->prixNuit = $prixNuit;

        return $this;
    }
    public function __construct($referHotel)
    {
        $this->referHotel =$referHotel;
    }
}
