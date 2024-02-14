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
    private ?DateTime $creationDate;

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

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Défini la date de création de l'utilisateur.
     *
     * @param string|DateTime $creationDate La date de création à définir. Il peut s'agir d'une chaîne ou d'un objet DateTime.
     * @param string $format Le format de la représentation sous forme de chaîne de la date lorsque $creationDate est une chaîne.
     * @retour void
     * @throws InvalidArgumentException Si $creationDate est une chaîne et que le format n'est pas valide.
     */
    public function setCreationDate(string|DateTime $creationDate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($creationDate)) {
            $parsedDate = DateTime::createFromFormat($format, $creationDate);

            if ($parsedDate === false) {
                throw new InvalidArgumentException("Format de date invalide. Le format attendu est $format");
            }

            $creationDate = $parsedDate;
        }
        $this->creationDate = $creationDate;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }
}