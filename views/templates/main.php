<?php
    /**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TomTroc</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://kit.fontawesome.com/2a6a340678.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="header">
            <div class="spacer"></div>
            <div class="logo-and-icon-header">
                <img class="logo-header" src="./images/illustration/logo_tom_troc.png" alt="Logo du site Tom Troc">
                <i class="fa-solid fa-bars ignore" id="icon-header-menu"></i>
            </div>

            <div class="header-menu" id="header-menu">
                <nav class="nav-site">
                    <ul class="nav-site-list">
                        <li class="ignore"><a href="index.php?action=home">Accueil</a></li>
                        <li class="ignore"><a href="index.php?action=library">Nos livres à l'échange</a></li>
                    </ul>
                </nav>
                <div class="spacer center"></div>
                <nav class="nav-user">
                    <ul class="nav-user-list">
                        <?php
                        if (isset($_SESSION['user'])) { ?>
                            <li class="ignore"><a href="index.php?action=messaging">Messagerie</a></li>
                            <li class="ignore"><a href="index.php?action=userAccount">Mon compte</a></li>
                            <li class="ignore"><a href="index.php?action=disconnect">Déconnexion</a></li>
                            <?php
                        } else { ?>
                            <li class="ignore"><a href="index.php?action=loginForm">Connexion</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="spacer"></div>
        </header>

        <main>
            <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
        </main>

        <footer>
            <nav class="nav-footer">
                <ul class="nav-footer-list">
                    <li class="ignore"><a href="index.php?action=privacyPolicy">Politique de confidentialité</a></li>
                    <li class="ignore"><a href="index.php?action=termsOfUse">Mentions légales</a></li>
                    <li>Tom Troc©</li>
                </ul>
                <img class="nav-logo-footer" src="../../images/illustration/logo_tom_troc_simple.png" alt="Logo du site Tom Troc">
            </nav>
        </footer>
        <script src="../../js/index.js" crossorigin="anonymous"></script>

    </body>
</html>
