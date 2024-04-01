<?php

class BookValidator implements ValidatorInterface
{
    private const string BOOK_TITLE_CHECK = "/^[A-Za-z0-9\s.,!?;:'\"()-]{3,144}$/";
    private const string BOOK_AUTHOR_CHECK = "/^[A-Za-z0-9\s.,()-]{3,32}$/";
    private const string BOOK_DESCRIPTION_CHECK = "/^[\p{L}\p{N}\p{P}\p{S}\p{Z}\p{Zl}\n\r]{50,500}$/u";

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = "Le champ titre ne peut pas être vide.";
        } elseif (!preg_match(self::BOOK_TITLE_CHECK, $data['title'])) {
            $errors['title'] = "Format du titre invalide. 3 à 144 caractères alphanumériques uniquement.";
        }

        if (empty($data['author'])) {
            $errors['author'] = "Le champ auteur ne peut pas être vide.";
        } elseif (!preg_match(self::BOOK_AUTHOR_CHECK, $data['author'])) {
            $errors['author'] = "Format de l'auteur invalide. 3 à 32 caractères alphanumériques uniquement.";
        }

        if (empty($data['description'])) {
            $errors['description'] = "Le champ de description ne peut pas être vide.";
        } elseif (!preg_match(self::BOOK_DESCRIPTION_CHECK, $data['description'])) {
            $errors['description'] = "Format de la description invalide. 50 à 500 caractères (UTF-8).";
        }

        if (!in_array($data['available'], ['0', '1'], true)) {
            $errors['available'] = "Champs de disponibilité invalide.";
        }

        return $errors;
    }
}