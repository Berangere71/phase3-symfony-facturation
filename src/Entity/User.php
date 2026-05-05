<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $company_name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $town = null;

    #[ORM\Column(length: 255)]
    private ?string $iban = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $siren = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Un identifiant visuel représentant l'utilisateur.
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // garantit que chaque utilisateur a au moins ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // Utile si tu stockes des données sensibles temporaires
    }

    // --- Tes autres getters/setters ---

    public function getFirstName(): ?string { return $this->first_name; }
    public function setFirstName(string $first_name): static { $this->first_name = $first_name; return $this; }

    public function getLastName(): ?string { return $this->last_name; }
    public function setLastName(string $last_name): static { $this->last_name = $last_name; return $this; }

    public function getCompanyName(): ?string { return $this->company_name; }
    public function setCompanyName(string $company_name): static { $this->company_name = $company_name; return $this; }

    public function getAdress(): ?string { return $this->adress; }
    public function setAdress(string $adress): static { $this->adress = $adress; return $this; }

    public function getPostalCode(): ?string { return $this->postalCode; }
    public function setPostalCode(string $postalCode): static { $this->postalCode = $postalCode; return $this; }

    public function getTown(): ?string { return $this->town; }
    public function setTown(string $town): static { $this->town = $town; return $this; }

    public function getIban(): ?string { return $this->iban; }
    public function setIban(string $iban): static { $this->iban = $iban; return $this; }

    public function getSiret(): ?string { return $this->siret; }
    public function setSiret(string $siret): static { $this->siret = $siret; return $this; }

    public function getSiren(): ?string { return $this->siren; }
    public function setSiren(string $siren): static { $this->siren = $siren; return $this; }
}
