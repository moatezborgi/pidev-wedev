<?php

namespace App\Entity;

use App\Repository\Reservation1Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=Reservation1Repository::class)
 */
class Reservation1
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
      */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="date is required")
     * @Assert\Date
     */
    private $date_reservation;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank(message="time is required")
     * @Assert\Time
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="nombre des personnes is required")
     * @Assert\Length(
     *      max = 2,
     *      minMessage = "Le numéro doit avoir au minimum {{ limit }} caractères"
     * )
     */
    private $nb_perso;

    /**
     * @ORM\Column(type="string", length=8)
   
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $refer_resto;

    public function __construct($refer_resto,$tel,$Nom,$Prenom){
        $this-> refer_resto=$refer_resto;
        $this->tel=$tel;
        $this->nom=$Nom;
        $this->prenom=$Prenom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeReservation(): ?int
    {
        return $this->code_reservation;
    }

    public function setCodeReservation(int $code_reservation): self
    {
        $this->code_reservation = $code_reservation;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }
    public function getdate_reservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getReferResto(): ?string
    {
        return $this->refer_resto;
    }
    public function getrefer_resto(): ?string
    {
        return $this->refer_resto;
    }

    public function setReferResto(string $refer_resto): self
    {
        $this->refer_resto = $refer_resto;
        

        return $this;
    }




}
