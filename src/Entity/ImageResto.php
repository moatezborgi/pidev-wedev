<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImageResto
 *
  * @ORM\Entity
 */
class ImageResto
{
    /**
     * @var int
     *
     * @ORM\Column(name="codimage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=true)
     */
    private $image ;
    /**
     * @var string|null
     *
     * @ORM\Column(name="refer_resto", type="string", length=200, nullable=true)
     */
    private $referResto;

    public function getCodimage(): ?int
    {
        return $this->codimage;
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

   
    public function getReferResto(): ?string
    {
        return $this->referResto;
    }

    public function setReferResto(?string $referResto): self
    {
        $this->referResto = $referResto;

        return $this;
    }



}
