<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="IDX_CE6064047BA88B4D", columns={"type_reclamation_id"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="merci d'ajouter  le description")
     */
    private $description;


    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     * @Assert\Positive(message="donner un entier posisitive")
     */
    private $count;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * message= " ce champs est obligatoire "
     * @ORM\Column(name="dateFac", type="date", nullable=false)
     */
    private $dateFac;
    /**
     * @var bool
     *
     * @ORM\Column(name="remboursement", type="boolean", nullable=false)
     */
    private $remboursement;

    /**
     * @var \TypeReclamation
     *
     * @ORM\ManyToOne(targetEntity="TypeReclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_reclamation_id", referencedColumnName="id")
     * })
     */
    private $typeReclamation;



      /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
      */
    private $login;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getRemboursement(): ?bool
    {
        return $this->remboursement;
    }

    public function setRemboursement(bool $remboursement): self
    {
        $this->remboursement = $remboursement;

        return $this;
    }

    public function getTypeReclamation(): ?TypeReclamation
    {
        return $this->typeReclamation;
    }

    public function setTypeReclamation(?TypeReclamation $typeReclamation): self
    {
        $this->typeReclamation = $typeReclamation;

        return $this;
    }
    public function getDateFac(): ?\DateTimeInterface
    {
        return $this->dateFac;
    }

    public function setDateFac(\DateTimeInterface $dateFac): self
    {
        $this->dateFac = $dateFac;

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
    public function __construct($login)

    {
     $this->login=$login;
    }

}
