<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entity_code;
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getEntityCode(): ?string
    {
        return $this->entity_code;
    }

    public function setEntityCode(string $entity_code): self
    {
        $this->entity_code = $entity_code;

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

    public function __construct($ref,$rating,$login)
    {
        $this->entity_code =$ref;
        $this->rating=$rating;
        $this->login=$login;
    }
}
