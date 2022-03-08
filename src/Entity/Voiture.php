<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=255)
     **@Assert\NotBlank(message="categorie  is required")
     */
    private $Categorie;

    /**
     * @ORM\Column(type="string", length=255)
     **@Assert\NotBlank(message="couleur   is required")
     */

    private $Couleur;

    /**
     * @ORM\Column(type="string", length=20)
     * *@Assert\NotBlank(message="carburant   is required")
     */
    private $Carburant;

    /**
     * @ORM\Column(type="integer")
     * *@Assert\NotBlank(message="nombre de palce  is required")
     */
    private $NbrdePlace;

    /**
     * @ORM\Column(type="date")
     * *@Assert\NotBlank(message=" DateDeMiseEnCirculation is required")
     *
     */
    private $DateDeMiseEnCirculation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Disponibilite;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="voiturealouer")
     */
    private $contrats;

    /**
     * @ORM\Column(type="float")
     */
    private $prixparheure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=Imagevoiture::class, mappedBy="refvoiture")
     */
    private $imagevoitures;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->imagevoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }

    public function setMatricule(string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->Carburant;
    }

    public function setCarburant(string $Carburant): self
    {
        $this->Carburant = $Carburant;

        return $this;
    }

    public function getNbrdePlace(): ?int
    {
        return $this->NbrdePlace;
    }

    public function setNbrdePlace(int $NbrdePlace): self
    {
        $this->NbrdePlace = $NbrdePlace;

        return $this;
    }

    public function getDateDeMiseEnCirculation(): ?\DateTimeInterface
    {
        return $this->DateDeMiseEnCirculation;
    }

    public function setDateDeMiseEnCirculation(\DateTimeInterface $DateDeMiseEnCirculation): self
    {
        $this->DateDeMiseEnCirculation = $DateDeMiseEnCirculation;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->Disponibilite;
    }

    public function setDisponibilite(bool $Disponibilite): self
    {
        $this->Disponibilite = $Disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, Contrat>
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setVoiturealouer($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getVoiturealouer() === $this) {
                $contrat->setVoiturealouer(null);
            }
        }

        return $this;
    }

    public function getPrixparheure(): ?float
    {
        return $this->prixparheure;
    }

    public function setPrixparheure(float $prixparheure): self
    {
        $this->prixparheure = $prixparheure;

        return $this;
    }
    public function __toString()
    {
        return(string)$this->getMatricule();
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Imagevoiture>
     */
    public function getImagevoitures(): Collection
    {
        return $this->imagevoitures;
    }

    public function addImagevoiture(Imagevoiture $imagevoiture): self
    {
        if (!$this->imagevoitures->contains($imagevoiture)) {
            $this->imagevoitures[] = $imagevoiture;
            $imagevoiture->setRefvoiture($this);
        }

        return $this;
    }

    public function removeImagevoiture(Imagevoiture $imagevoiture): self
    {
        if ($this->imagevoitures->removeElement($imagevoiture)) {
            // set the owning side to null (unless already changed)
            if ($imagevoiture->getRefvoiture() === $this) {
                $imagevoiture->setRefvoiture(null);
            }
        }

        return $this;
    }
}
