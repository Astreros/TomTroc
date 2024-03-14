<?php

use JetBrains\PhpStorm\NoReturn;

class BookController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function addBook(): void
    {
        Utils::checkIfUserIsConnected();

        Utils::redirectWithoutParamsInUrl('bookFormCreate');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateBook(): void
    {
        Utils::checkIfUserIsConnected();

        $IdBookToBeUpdated = Utils::request('id');

        if (!$IdBookToBeUpdated) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['errorNoBookToUpdate' => 'Aucun livre à mettre a jour.']);
        }

        $bookManager = new BookManager();
        $bookToBeUpdated = $bookManager->getBookById($IdBookToBeUpdated);

        if ($bookToBeUpdated === null) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['errorBookHasNotBeenFound' => 'Le livre à mettre à jour n\'a pas été trouvé. ']);
        }

        $_SESSION['bookToBeUpdated'] = $bookToBeUpdated->toArray();
        Utils::redirectWithoutParamsInUrl('bookFormUpdate');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function UpdatingBook(): void
    {
        $rawData = [
            'id'=> strip_tags(Utils::request('id')),
            'title' => strip_tags(Utils::request('title')),
            'author' => strip_tags(Utils::request('author')),
            'description' => strip_tags(Utils::request('description')),
            'image' => $_FILES['imageToUpload'],
            'available' => strip_tags(Utils::request('available')),
            'oldImage' => strip_tags(Utils::request('oldImage'))
        ];

        $bookValidator = new BookValidator();
        $imageValidator = new ImageValidator();

        $bookErrors = $bookValidator->validate($rawData);

        if ($_FILES['imageToUpload']['error'] !== UPLOAD_ERR_NO_FILE) {
            $imageErrors = $imageValidator->validate($rawData);

            if (!empty($bookErrors) || !empty($imageErrors)) {
                Utils::redirectWithoutParamsInUrl('bookFormUpdate', [
                    'errors' => array_merge($bookErrors, $imageErrors),
                    'tempData' => $rawData
                ]);
            }

            $imagePath = Utils::uploadImageFile($rawData['image'], 'books', BOOKS_IMAGE_DIRECTORY);

            if (!$imagePath['success']) {
                Utils::redirectWithoutParamsInUrl('bookFormCreate', [
                    'errors' => $imagePath['message'],
                    'tempData' => $rawData
                ]);
            } else {
                $imagePath = $imagePath['message'];
            }

            Utils::deleteImageFile($rawData['oldImage']);

        } else {
            $imagePath = $rawData['oldImage'];
        }

        if (!empty($bookErrors)) {
            Utils::redirectWithoutParamsInUrl('bookFormUpdate', [
                'errors' => $bookErrors,
                'tempData' => $rawData
            ]);
        }

        $book = [
            'id' => htmlspecialchars($rawData['id']),
            'title' => htmlspecialchars($rawData['title']),
            'author' => htmlspecialchars($rawData['author']),
            'description' => htmlspecialchars($rawData['description']),
            'image' => $imagePath,
            'available' => htmlspecialchars($rawData['available'])
        ];

        $bookManager = new BookManager();
        $bookManager->updateBook($book);

        Utils::redirect('userAccount');
    }


    /**
     * @throws Exception
     */
    #[NoReturn] public function createBook(): void
    {
        $userId = $_SESSION['user']->getId();

        $rawData = [
            'title' => strip_tags(Utils::request('title')),
            'author' => strip_tags(Utils::request('author')),
            'description' => strip_tags(Utils::request('description')),
            'image' => $_FILES['imageToUpload'],
            'available' => strip_tags(Utils::request('available'))
        ];

        $bookValidator = new BookValidator();
        $imageValidator = new ImageValidator();

        $bookErrors = $bookValidator->validate($rawData);
        $imageErrors = $imageValidator->validate($rawData);

        if (!empty($bookErrors) || !empty($imageErrors)) {
            Utils::redirectWithoutParamsInUrl('bookFormCreate', [
                'errors' => array_merge($bookErrors, $imageErrors),
                'tempData' => $rawData
            ]);
        }

        $imagePath = Utils::uploadImageFile($rawData['image'], 'books', BOOKS_IMAGE_DIRECTORY);

        if (!$imagePath['success']) {
            Utils::redirectWithoutParamsInUrl('bookFormCreate', [
                'errors' => $imagePath['message'],
                'tempData' => $rawData
            ]);
        } else {
            $imagePath = $imagePath['message'];
        }

        $book = new Book([
            'title' => htmlspecialchars($rawData['title'], ENT_QUOTES),
            'author' => htmlspecialchars($rawData['author'], ENT_QUOTES),
            'description' => htmlspecialchars($rawData['description'], ENT_QUOTES),
            'image' => $imagePath,
            'available' => htmlspecialchars($rawData['available'], ENT_QUOTES),
            'creation_date' => new DateTime()
        ]);

        $bookManager = new BookManager();
        $bookManager->addBook($book, $userId);

        Utils::redirect('bookDetails');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function deleteBook(): void
    {
        $idBookToBeDeleted = $_REQUEST['idBookToBeDeleted'];

        if (empty($idBookToBeDeleted)) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['deleteError' => 'Aucun livre à supprimer']);
        }

        $bookManager = new BookManager();
        $bookToBeDeleted = $bookManager->getBookById($idBookToBeDeleted);

        if ($bookToBeDeleted === null) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['errors' => 'Livre non trouvé.']);
        }

        $imageBookToBeDeleted = $bookToBeDeleted->getImage();

        if ($imageBookToBeDeleted === null) {
            $bookManager->deleteBookById($idBookToBeDeleted);

        }

        Utils::deleteImageFile($imageBookToBeDeleted);
        $bookManager->deleteBookById($idBookToBeDeleted);

        Utils::redirect('userAccount');
    }
}
