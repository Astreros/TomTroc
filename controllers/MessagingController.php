<?php

class MessagingController
{
    /**
     * @throws Exception
     */
    public function showMessaging(): void
    {
        $view = new View('Messagerie');
        $view->render('messaging', ['variableTest' => 'Hello World ! Page de messagerie']);
    }
}