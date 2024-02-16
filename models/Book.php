<?php

class Book extends AbstractEntity
{
    private string $title;
    private string $author;
    private string $description;
    private ?string $image = null;
    private bool $available;

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function getAvailable(): bool
    {
        return $this->available;
    }
}