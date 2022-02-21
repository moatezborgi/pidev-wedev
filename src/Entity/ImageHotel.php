<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ImageHotel
 *
 * @ORM\Table(name="image_hotel", indexes={@ORM\Index(name="fk_image", columns={"refer_hotel"})})
 * @ORM\Entity
 */
class ImageHotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="code_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codeImage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=true)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refer_hotel", type="string", length=50, nullable=true)
     */
    private $referHotel;

    public function getCodeImage(): ?int
    {
        return $this->codeImage;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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


}
