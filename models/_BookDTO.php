<?php
class BookDTO
{
    private string $title;
    private string $author;
    private string $description;
    private bool $available;
    private array $errors = [];

    public function __construct(
        string $title,
        string $author,
        string $description,
        bool $available
    ) {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setDescription($description);
        $this->setAvailable($available);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (!preg_match(BOOK_TITLE_CHECK, $title)) {
            $this->errors['title'] = "Format du titre invalide. 3 à 144 caractères alphanumériques uniquement.";
            return;
        }

        $this->title = strip_tags($title);
        $this->title = htmlspecialchars($this->title);
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        if (!preg_match(BOOK_AUTHOR_CHECK, $author)) {
            $this->errors['author'] = "Format de l'auteur invalide. 3 à 32 caractères alphanumériques uniquement.";
            return;
        }

        $this->author = strip_tags($author);
        $this->author = htmlspecialchars($this->author);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        if (!preg_match(BOOK_DESCRIPTION_CHECK, $description)) {
            $this->errors['description'] = "Format de la description invalide. 50 à 500 caractères (UTF-8).";
            return;
        }

        $this->description = strip_tags($description);
        $this->description = htmlspecialchars($this->description);
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        if (!($available === true || $available === false)) {
            $this->errors['available'] = "Champs de disponibilité invalide.";
            return;
        }

        $this->available = $available;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}