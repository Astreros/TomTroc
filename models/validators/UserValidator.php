<?php

class UserValidator implements ValidatorInterface
{
    private const string USER_USERNAME_CHECK = "/^[a-zA-Z0-9_]{3,32}$/";
    private const string USER_EMAIL_CHECK = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3,}$/";
    private const string USER_PASSWORD_CHECK = "/^(?=.*[a-z])(?=.*[A-Z])[\w\s]{12,}$/";

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = "Le champ de nom d'utilisateur ne peut pas être vide.";
        } elseif (!preg_match(self::USER_USERNAME_CHECK, $data['username'])) {
            $errors['username'] = "Format du nom d'utilisateur invalide. 3 à 32 caractères alphanumériques et underscore uniquement.";
        }

        if (empty($data['email'])) {
            $errors['email'] = "Le champ d'e-mail ne peut pas être vide.";
        } elseif (!preg_match(self::USER_EMAIL_CHECK, $data['email'])) {
            $errors['email'] = "Format d'e-mail invalide.";
        }

        if (empty($data['password'])) {
            $errors['password'] = "Le champ de mot de passe ne peut pas être vide.";
        } elseif (!preg_match(self::USER_PASSWORD_CHECK, $data['password'])) {
            $errors['password'] = "Format de mot de passe invalide.";
        }

        return $errors;
    }
}
