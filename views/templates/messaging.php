<?php
?>

<section class="messaging">
    <div class="overall-threads">
        <h2>Messagerie</h2>

        <div class="thread-discussion">
            <!--  ZONE BOUCLE PHP  -->
            <a href="#" class="discussion-link selected">
                <img src="./images/users/adam-winger-aCajfuNQAN4-unsplash.jpg" alt="username">
                <div class="discussion-info">
                    <p class="discussion-contact">Hamzalecture</p>
                    <p class="extract-last-message">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="discussion-date-time">15:43</div>
            </a>
            <!--  FIN BOUCLE PHP  -->
        </div>
    </div>

    <div class="view-discussion">
        <a href="index.php?action=messaging" class="back-to-overall-threads"><- retour</a>
        <div  class="contact-discussion">
            <img src="./images/users/adam-winger-aCajfuNQAN4-unsplash.jpg" alt="username">
            <a href="index.php?action=publicUserAccount&id=18"><div class="contact-username">Hamzalecture</div></a>
        </div>

        <div class="discussion">
            <!--  ZONE BOUCLE PHP  -->
            <div class="message">
                <div class="message-info">
                    <img src="./images/users/adam-winger-aCajfuNQAN4-unsplash.jpg" alt="username">
                    <div class="message-date-time">21.08 15:48</div>
                </div>
                <div class="message-content">
                    Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                </div>
            </div>
            <!--  FIN BOUCLE PHP  -->

            <div class="message end">
                <div class="message-info reverse">
                    <img src="./images/users/users65e09bebf3b893.14494778.jpg" alt="username">
                    <div class="message-date-time">21.08 15:48</div>
                </div>
                <div class="message-content">
                    Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                </div>
            </div>
            <div class="message">
                <div class="message-info">
                    <img src="./images/users/adam-winger-aCajfuNQAN4-unsplash.jpg" alt="username">
                    <div class="message-date-time">21.08 15:48</div>
                </div>
                <div class="message-content">
                    Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                </div>
            </div>

        </div>

        <div class="add-message-bloc">
            <form action="">
                <label for="add-message"></label>
                <textarea id="add-message" name="message" placeholder="Tapez votre message ici"></textarea>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</section>