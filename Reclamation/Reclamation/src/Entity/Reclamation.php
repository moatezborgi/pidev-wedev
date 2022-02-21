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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="merci d'ajouter  l'etat")

     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     * @Assert\Positive(message="donner un entier posisitive")

     */
    private $count;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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


}
