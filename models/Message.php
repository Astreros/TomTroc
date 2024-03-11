<?php

class Message extends AbstractEntity
{
    private string $content;
    private bool $isRead;
    private int $idSender;
    private int $idRecipient;

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return  $this->content;
    }

    public function setIsRead($isRead): void
    {
        $this->isRead = $isRead;
    }

    public function getIsRead(): bool
    {
        return $this->isRead;
    }

    public function setIdSender($idSender = false): void
    {
        $this->idSender = $idSender;
    }

    public function getIdSender(): int
    {
        return $this->idSender;
    }

    public function setIdRecipient($idRecipient): void
    {
        $this->idRecipient = $idRecipient;
    }

    public function getIdRecipient(): int
    {
        return $this->idRecipient;
    }
}