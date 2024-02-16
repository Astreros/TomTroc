<?php

/**
 * L'entité User. Défini par les champs suivants :
 * id (AbstractEntity), username, email, password, image et creationDate.
 *
 * Hérite de AbstractEntity.
 *
 * @author leprini
 */
class User extends AbstractEntity
{
    private string $username;
    private string $email;
    private string $password;
    private ?string $image = null;

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
}