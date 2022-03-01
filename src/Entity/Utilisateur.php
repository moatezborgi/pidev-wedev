<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements  UserInterface
{
    const ROLE_ADMIN="ROLE_ADMIN";
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Login is required")
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Email is required")
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(
     *      min = 6,
     *      minMessage = "the password must be at least {{ limit }} characters long",
     *
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="nom is required")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="prenom is required")
     */
    private $prenom;
    /**
     * @ORM\Column(type="date")
     */
         private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="genre is required")
     */
    private $genre;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     *
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

   /**
    * @ORM\Column(type="json", length=255)
    */
   private $roles =[];
    /**
    * @ORM\Column(type="string", length=255)
     */
    private $imageuser;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->genre = $Genre;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTEL(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getImageuser(): ?string
    {
        return $this->imageuser;
    }

    public function setImageuser(string $imageuser): self
    {
        $this->imageuser = $imageuser;

        return $this;
    }

    /////////
    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }






    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function isAdmin():bool{
        return in_array(self::ROLE_ADMIN,$this->getRoles());
    }
}
