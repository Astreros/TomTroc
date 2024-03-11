<?php

class MessageManager extends AbstractEntityManager
{
    public function addMessage(Message $message): void
    {
        $statement = "INSERT INTO messages (content, is_read ,creation_date, Id_sender, Id_recipient) VALUES (:content, :is_read ,:creation_date, :Id_sender, :Id_recipient)";

        $this->database->query($statement,
        [
            'content' => $message->getContent(),
            'is_read' => $message->getIsRead(),
            'creation_date' => $message->getCreationDateString(),
            'Id_sender' => $message->getIdSender(),
            'Id_recipient' => $message->getIdRecipient()
        ]);
    }
}