<?php

class ImageValidator implements ValidatorInterface
{
    private const array ALLOWED_MIME_TYPES = ['image/jpeg', 'image/jpeg', 'image/png'];
    private const int MAX_IMAGE_SIZE = 1048576 * 100; // 100 Mo

    public function validate(array $data): array
    {
        $errors = [];

        if (!isset($data['image']) || !is_array($data['image'])) {
            $errors['uploadError'] = "La récupération de l'image a échoué.";
            return $errors;
        }

        if ($data['image']['error'] !== UPLOAD_ERR_OK) {
            $errors['uploadError'] = "Une erreur s'est produite lors du téléchargement de l'image. Vérifié que vous avez bien ajouté une image pour votre livre.";
            return $errors;
        }

        if ($data['image']['size'] > self::MAX_IMAGE_SIZE) {
            $errors['sizeError'] = "La taille de l'image ne doit pas dépasser 100 Mo.";
        }

        $fileMimeType = finfo_open(FILEINFO_MIME_TYPE);
        $typeMime = finfo_file($fileMimeType, $data['image']['tmp_name']);
        finfo_close($fileMimeType);

        if (!in_array($typeMime, self::ALLOWED_MIME_TYPES, true)) {
            $errors['formatError'] = "Uniquement les images JPEG/JPG et PNG sont acceptées.";
        }

        return $errors;
    }
}