<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Surname;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private UuidInterface $id,
        private Name $name,
        private Surname $surname,
        private Email $email,
        private Password $password,
        private array $roles = []
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->$id = $id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): Surname
    {
        return $this->surname;
    }

    public function setSurname(Surname $surname): void
    {
        $this->surname = $surname; 
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->$email = $email;
    }

    public function getVOPassword(): Password
    {
        return $this->password;
    }

    public function seVOPassword(Password $password): void
    {
        $this->password = $password;
    }
    public function getPassword(): ?string
    {
        return $this->password->value();
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the roles granted to the user.
     */
    public function getRoles(): array
    {
        // Garantizar que cada usuario tenga al menos el rol ROLE_USER
        if (empty($this->roles)) {
            $this->roles[] = 'ROLE_USER';
        }

        return array_unique($this->roles);
    }

    /**
     * Set the roles for the user.
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * Get the user identifier (e.g., email).
     */
    public function getUserIdentifier(): string
    {
        return $this->email; // O cualquier otro identificador único
    }

    /**
     * Erase any sensitive information.
     */
    public function eraseCredentials(): void
    {
        // Si hay información sensible que deseas eliminar, hazlo aquí.
        // Por ejemplo, si usaste una contraseña sin encriptar durante la autenticación:
        // $this->plainPassword = null; // O cualquier otro campo temporal.
    }
}
