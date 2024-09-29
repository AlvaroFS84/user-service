<?php

namespace App\Infrastructure\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    private ?int $id = null;

    private ?string $email = null;

    private ?string $name = null;

    private ?string $surname = null;

    private ?string $password = null;

    private array $roles = [];

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

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
