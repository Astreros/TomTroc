<?php
    if (isset($_SESSION['errors'], $_SESSION['tempData'])) {
        $errors = $_SESSION['errors'];
        $tempData = $_SESSION['tempData'];
    }
?>

<section class="messaging">
    <div class="overall-threads">
        <h2>Messagerie</h2>

        <div class="thread-discussion">
            <?php
            foreach ($conversations as $conversation) { ?>
                <?php
                $lastMessage = end($conversation['messages']);

                $selected = null;

                if (isset($contact) && $conversation['interlocutor_id'] === $contact->getId()) {
                    $selected = 'selected';
                }
                ?>
                <a href="index.php?action=messaging&contact=<?= $conversation['interlocutor_id']?>" class="discussion-link <?= $selected ? 'selected' : ''?>">
                    <img src="<?= $conversation['interlocutor']->getImage() ?>" alt="<?= $conversation['interlocutor']->getUsername() ?>">
                    <div class="discussion-info">
                        <p class="discussion-contact"><?= $conversation['interlocutor']->getUsername() ?></p>
                        <p class="extract-last-message"><?=substr($lastMessage->getContent(), 0, 20) ?><?= strlen($lastMessage->getContent()) > 20 ? '...' : $lastMessage->getContent() ?></p>
                    </div>
                    <div class="discussion-date-time"><?= $lastMessage->getShortDateTimeFormat() ?></div>
                </a><?php
            } ?>
        </div>
    </div>

    <div class="view-discussion">
        <a href="index.php?action=messaging" class="back-to-overall-threads"><- retour</a>

        <?php
        if (isset($contact)) { ?>
            <div  class="contact-discussion">
                <img src="<?= $contact->getImage() ?? USER_IMAGE_DEFAULT_PATH ?>" alt="<?= $contact->getUsername() ?>">
                <a href="index.php?action=publicUserAccount&id=<?= $contact->getId() ?>">
                    <div class="contact-username">
                        <?= $contact->getUsername() ?>
                    </div>
                </a>
            </div>

            <div class="discussion">
                <?php
                foreach ($conversations as $conversation) {
                    if ($conversation['interlocutor_id'] === $contact->getId()) { // Vérifiez si l'interlocuteur de la conversation est le même que le contact sélectionné
                        foreach ($conversation['messages'] as $message) {
                            if ($message->getIdSender() === $_SESSION['user']->getId()) { // Vérifiez si le message a été envoyé par l'utilisateur courant
                                ?>
                                <div class="message end">
                                    <div class="message-info end">
                                        <img src="<?= $_SESSION['user']->getImage() ?>" alt="username">
                                        <div class="message-date-time"><?= $message->getFrenchTimeFormat() ?></div>
                                    </div>
                                    <div class="message-content"><?= $message->getContent() ?></div>
                                </div>
                                <?php
                            } else { // Sinon, le message a été envoyé par l'interlocuteur
                                ?>
                                <div class="message">
                                    <div class="message-info">
                                        <img src="<?= $contact->getImage() ?>" alt="username">
                                        <div class="message-date-time"><?= $message->getCreationDateString() ?></div>
                                    </div>
                                    <div class="message-content"><?= $message->getContent() ?></div>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </div>

            <div class="add-message-bloc">
                <form  method="POST" action="index.php?action=addMessage" >
                    <label for="add-message"></label>
                    <textarea id="add-message" name="message"  minlength="1" maxlength="500" placeholder="Tapez votre message ici" required ><?= $messageToSend['content']  ?? '' ?></textarea>
                    <input type="hidden" name="recipientId" value="<?= $contact->getId() ?>">
                    <input type="submit" value="Envoyer">
                </form>
            </div>

            <div class="error-box">
                <?php
                if (isset($errors)) {
                    if (is_array($errors)) {
                        foreach ($errors as $error => $value) {
                            echo $value . '<br/>';
                        }
                    } else {
                        echo $errors;
                    }
                }
                ?>
            </div>

        <?php } else  { ?>
            <div class="discussion">
                <!--  ZONE BOUCLE PHP  -->
                <div class="message">Veuillez sélectionner une conversation ou créer en une</div>
                <!--  FIN BOUCLE PHP  -->
        <?php }
        ?>
    </div>
</section>