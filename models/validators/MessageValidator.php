<?php

class MessageValidator implements ValidatorInterface
{
    const MESSAGE_CHECK = "/^[\p{L}\p{N}\p{P}\p{S}\p{Z}\p{Zl}\n\r]{1,500}$/u";

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['content'])) {
            $errors['content'] = "Le message ne peut être vide.";
        } elseif (!preg_match(self::MESSAGE_CHECK, $data['content'])) {
            $errors['content'] = "Format du message invalide. 1 à 500 caractères (UTF-8).";
        }

        return $errors;
    }
}