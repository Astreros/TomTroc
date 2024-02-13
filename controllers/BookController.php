<?php

class BookController
{
    /**
     * @throws Exception
     */
    public function addBook(): void
    {
        $view = new View('Ajouter un livre');
        $view->render('userBook', ['variableTest' => 'Hello World ! Page d\'ajout d\'un livre']);
    }

    /**
     * @throws Exception
     */
    public function updateBook(): void
    {
        $view = new View('Modifier un livre');
        $view->render('userBook', ['variableTest' => 'Hello World ! Page de modification d\'un livre']);
    }
}
