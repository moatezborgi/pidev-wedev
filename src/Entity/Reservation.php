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
      */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
      */
    private $Prenom;

    /**
     * @ORM\Column(type="integer")
      */
    private $nb_perso;

    /**
     * @ORM\Column(type="string", length=8)
 
     */
    private $tel;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $refer_offre;
      /**
     * @ORM\Column(type="string", length=255)
      */
      private $login;


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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }
    public function __construct($refer_offre,$Nom,$Prenom,$tel,$login)
    {
        $this->refer_offre =$refer_offre;
        $this->tel=$tel;
        $this->Nom=$Nom;
        $this->Prenom=$Prenom;
        $this->login = $login;


    }
}
