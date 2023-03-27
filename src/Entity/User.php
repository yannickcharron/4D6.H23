<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name:'profiles')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'idProfile')]
    private ?int $idProfile = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Length(min:3, minMessage:"Le nom d'utilisateur doit contenir {{ limit }} caractères minimum")]
    #[Assert\Length(max:20, maxMessage:"Le nom d'utilisateur doit contenir {{ limit }} caractères maximum")]
    private ?string $username = null;

    #[ORM\Column(length:150, unique:true)]
    #[Assert\Email(message:"Votre adresse courriel: {{ value }} est invalide")]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(name:'lastName')]
    #[Assert\Length(min:2, minMessage:"Votre nom doit contenir {{ limit }} caractères minimum")]
    #[Assert\Length(max:75, maxMessage:"Votre nom doit contenir {{ limit }} caractères maximum")]
    private ?string $lastName = null;

    #[ORM\Column(name:'firstName')]
    #[Assert\Length(min:2, minMessage:"Votre prénom doit contenir {{ limit }} caractères minimum")]
    #[Assert\Length(max:75, maxMessage:"Votre prénom doit contenir {{ limit }} caractères maximum")]
    private ?string $firstName = null;

    #[ORM\Column(length:20, nullable:true)]
    #[Assert\Regex(pattern:"/^[0-9]{10}$/", message:"Votre téléphone doit contenir 10 chiffres" )]
    private ?string $phone = null;

    #[ORM\Column(name:'betaKey')]
    #[Assert\Regex(pattern:"/^(Y|K)[0-9]{5}-([A-Z0-9]{4}-){3}(A|B)$/", message:"Le clé ne respecte pas le format attendu")]
    private ?string $betaKey = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function getIdProfile(): ?int
    {
        return $this->idProfile;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBetaKey(): ?string
    {
        return $this->betaKey;
    }

    public function setBetaKey(string $betaKey): self
    {
        $this->betaKey = $betaKey;

        return $this;
    }




    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
