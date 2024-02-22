<?php

class MessagingController
{
    /**
     * @throws Exception
     */
    public function showMessaging(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View('Messagerie');
        $view->render('messaging');
    }
}