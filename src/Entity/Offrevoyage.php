<?php

namespace App\Entity;

use App\Repository\OffrevoyageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=OffrevoyageRepository::class)
 */
class Offrevoyage
{
  

    /**
     * @ORM\Id

     * @ORM\Column(type="string", length=255)
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Champ requis")
     * 
     */
    private $prix_offre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nb_place;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $descriptions;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $lieu_depart;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $lieu_arrivee;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nb_nuits;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nb_jours;

    /**
     * @ORM\Column(type="date")
 * @Assert\GreaterThan("today")

     */
    private $date_depart;

    /**
     * @ORM\Column(type="date")

     */
    private $date_retour;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="offrevoyages")
     */
    private $hotel;

    public function getId(): ?string
    {
        return $this->id;
    }

  

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPrixOffre(): ?float
    {
        return $this->prix_offre;
    }
    public function getprix_offre(): ?float
    {
        return $this->prix_offre;
    }

    public function setPrixOffre(float $prix_offre): self
    {
        $this->prix_offre = $prix_offre;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }
    public function getnb_place(): ?int
    {
        return $this->nb_place;
    }
    public function setNbPlace(int $nb_place): self
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getDescriptions(): ?string
    {
        return $this->descriptions;
    }

    public function setDescriptions(string $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieu_depart;
    }
    public function getlieu_depart(): ?string
    {
        return $this->lieu_depart;
    }
    public function setLieuDepart(string $lieu_depart): self
    {
        $this->lieu_depart = $lieu_depart;

        return $this;
    }

    public function getLieuArrivee(): ?string
    {
        return $this->lieu_arrivee;
    }
    public function getlieu_arrivee(): ?string
    {
        return $this->lieu_arrivee;
    }
    public function setLieuArrivee(string $lieu_arrivee): self
    {
        $this->lieu_arrivee = $lieu_arrivee;

        return $this;
    }

    public function getNbNuits(): ?int
    {
        return $this->nb_nuits;
    }
    public function getnb_nuits(): ?int
    {
        return $this->nb_nuits;
    }
    public function setNbNuits(int $nb_nuits): self
    {
        $this->nb_nuits = $nb_nuits;

        return $this;
    }

    public function getNbJours(): ?int
    {
        return $this->nb_jours;
    }
    public function getnb_jours(): ?int
    {
        return $this->nb_jours;
    }
    public function setNbJours(int $nb_jours): self
    {
        $this->nb_jours = $nb_jours;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }
    public function getdate_depart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }
    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }
    public function getdate_retour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }
    public function setDateRetour(\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
