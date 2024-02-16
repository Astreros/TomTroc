<?php

class BookController
{
    /**
     * @throws Exception
     */
    public function addBook(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View('Ajouter un livre');
        $view->render('userBook');
    }

    /**
     * @throws Exception
     */
    public function updateBook(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View('Modifier un livre');
        $view->render('userBook');
    }
}
