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
        <link rel="stylesheet" href="../../css/style.css">
    </head>

    <body>
        <header>
            <p>Ici le header.</p>
        </header>

        <main>
            <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
        </main>

        <footer>
            <nav>
                <ul>
                    <li><a href="index.php?action=home">Accueil</a></li>
                    <li><a href="index.php?action=library">Nos livres à l'échange</a></li>
                    <li><a href="index.php?action=bookDetails">Détails d'un livre</a></li>
                    <li><a href="index.php?action=publicUserAccount">Compte public utilisateur</a></li>
                    <li><a href="index.php?action=login">Formulaire de connexion</a></li>
                    <li><a href="index.php?action=registration">Formulaire d'inscription</a></li>
                    <li><a href="index.php?action=userAccount">Compte utilisateur</a></li>
                    <li><a href="index.php?action=createBook">Ajout d'un livre </a></li>
                    <li><a href="index.php?action=updateBook">Modification d'un livre</a></li>
                    <li><a href="index.php?action=messaging">Messagerie utilisateur</a></li>
                    <li><a href="index.php?action=privacyPolicy">Politiques de confidentialité</a></li>
                    <li><a href="index.php?action=termsOfUse">Mentions légales</a></li>
                </ul>
            </nav>


            <p>Copyright © TomTroc 2024 - Openclassrooms</p>
        </footer>

        <script src="https://kit.fontawesome.com/2a6a340678.js" crossorigin="anonymous"></script>
    </body>
</html>
