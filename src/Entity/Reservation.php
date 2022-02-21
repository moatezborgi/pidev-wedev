<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ requis")
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Champ requis")
     */
    private $nb_perso;

    /**
     * @ORM\Column(type="string", length=8)
     * @Assert\NotBlank(message="Champ requis")
    * @Assert\Length(min=8,max=8,minMessage="Ce champ doit contenir au moins 8 caractères",maxMessage="Ce champ doit contenir au plus 8 caractères")

     */
    private $tel;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $refer_offre;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function referOffre(): ?string
    {
        return $this->refer_offre;
    }
    public function getNom(): ?string
    {
        return $this->Nom;
    }
    
    public function setreferOffre(string $refer_offre): self
    {
        $this->refer_offre = $refer_offre;

        return $this;
    }


    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getNbPerso(): ?int
    {
        return $this->nb_perso;
    }
    public function getnb_perso(): ?int
    {
        return $this->nb_perso;
    }

    public function setNbPerso(int $nb_perso): self
    {
        $this->nb_perso = $nb_perso;

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
    public function __construct($refer_offre)
    {
        $this->refer_offre =$refer_offre;
    }
}
