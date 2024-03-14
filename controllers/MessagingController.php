<?php

use JetBrains\PhpStorm\NoReturn;

class MessagingController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function showMessaging(): void
    {
        Utils::checkIfUserIsConnected();

        $contact = Utils::request('contact', 0);
        $idUser = $_SESSION['user']->getId();

        $messageManager = new MessageManager();
        $messages = $messageManager->getAllMessagesByUserId($idUser);

        if ($contact !== 0) {
            $userManager = new UserManager();
            $contact = $userManager->getUserById($contact);

            $conversations = $this->allMessagesToConversationsFormat($messages);

            Utils::redirectWithoutParamsInUrl('messaging', [
                'conversations' => $conversations,
                'contact' => $contact
            ]);
        }

        if ($messages !== null) {
            $conversations = $this->allMessagesToConversationsFormat($messages);

            Utils::redirectWithoutParamsInUrl('messaging', [
                'conversations' => $conversations,
                'contact' => null
            ]);
        }

        Utils::redirectWithoutParamsInUrl('messaging');
    }

    public function allMessagesToConversationsFormat(array $messages): array
    {
        $idUser = $_SESSION['user']->getId();
        $conversations = [];

        foreach ($messages as $message) {
            $idSender = $message->getIdSender();
            $idRecipient = $message->getIdRecipient();

            $conversationKey = min($idSender, $idRecipient) . "_" . max($idRecipient, $idSender);

            if (!isset($conversations[$conversationKey])) {
                $conversations[$conversationKey] = [
                    'messages' => [],
                    'interlocutor_id' => $idSender === $idUser ? $idRecipient : $idSender
                ];
            }

            $conversations[$conversationKey]['messages'][] = $message;
        }

        foreach ($conversations as &$conversation) {
            $userManager = new UserManager();
            $interlocutor = $userManager->getUserById($conversation['interlocutor_id']);

            usort($conversation['messages'], static function ($a, $b) {
                return $a->getCreationDate() <=> $b->getCreationDate();
            });

            $conversation['interlocutor'] = $interlocutor;
        }

        return $conversations;
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function addMessage(): void
    {
        Utils::checkIfUserIsConnected();

        $idUser = $_SESSION['user']->getId();
        $idRecipient = (int)strip_tags(Utils::request('recipientId'));

        $userManager = new UserManager();
        $recipient = $userManager->getUserByBookId($idRecipient);

        if ($recipient === null) {
            Utils::redirectWithoutParamsInUrl('messaging', [
                'errors' => 'Destinataire non trouvé.'
            ]);
        }

        $rawData = [
            'content' => strip_tags(Utils::request('message'))
        ];

        $messageValidator = new MessageValidator();

        $messageErrors = $messageValidator->validate($rawData);

        if (!empty($messageErrors)) {

            $_SESSION['errors'] = $messageErrors;
            $_SESSION['tempData'] = $rawData;

            Utils::redirect('messaging', [
                'contact' => $idRecipient
            ]);
        }

        unset($_SESSION['errors'], $_SESSION['rawData']);

        $message = new Message([
            'content' => htmlspecialchars($rawData['content']),
            'is_read' => 0,
            'id_sender' => $idUser,
            'id_recipient' => $idRecipient,
            'creation_date' => new DateTime()
        ]);

        $messageManager = new MessageManager();
        $messageManager->addMessage($message);

        Utils::redirect('messaging', [
            'contact' => $idRecipient
        ]);
    }
}