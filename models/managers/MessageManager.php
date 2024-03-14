<?php

class MessageManager extends AbstractEntityManager
{
    public function addMessage(Message $message): void
    {
        $statement = "INSERT INTO 
                        messages (content, is_read ,creation_date, Id_sender, Id_recipient) 
                    VALUES (:content, :is_read ,:creation_date, :Id_sender, :Id_recipient)";

        $this->database->query($statement,
        [
            'content' => $message->getContent(),
            'is_read' => $message->getIsRead(),
            'creation_date' => $message->getCreationDateString(),
            'Id_sender' => $message->getIdSender(),
            'Id_recipient' => $message->getIdRecipient()
        ]);
    }

    public function getAllMessagesByUserId($userId): array|null
    {
        $messages = [];

        $statement = "SELECT *,
                        Id_messages AS id,
                        Id_sender AS idSender,
                        Id_recipient AS idRecipient
                    FROM messages 
                    WHERE Id_sender = :userId 
                       OR Id_recipient = :userId 
                    ORDER BY creation_date";

        $result = $this->database->query($statement, ['userId' => $userId]);

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }

        return !empty($messages) ? $messages : null;
    }
}
