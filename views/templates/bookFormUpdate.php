<?php
    $preFilled = false;
    $bookToBeUpdated = null;

    if (isset( $_SESSION['bookToBeUpdated'])) {
        $bookToBeUpdated = $_SESSION['bookToBeUpdated'];
        $preFilled = true;
    }
?>

<section class="book-form">
    <div class="book-form-head">
        <a href="index.php?action=userAccount"><- retour</a>
        <h2>Modifier les informations</h2>
    </div>

    <form method="POST" action="index.php?action=updatingBook" enctype="multipart/form-data">
        <div class="left-book-form">
            <label for="imageToUpload">Photo</label>
            <img src="<?= $preFilled ? $bookToBeUpdated->getImage()  : '' ?>" alt="<?=  $preFilled ? $bookToBeUpdated->getTitle()  : '' ?>">
            <input type="hidden" name="oldImage" id="oldImage" value="<?= $preFilled ? $bookToBeUpdated->getImage()  : '' ?>">
            <input type="hidden" name="id" id="id" value="<?= $bookToBeUpdated->getId() ?>">
            <input type="file" name="imageToUpload" id="imageToUpload">
        </div>

        <div class="right-book-form">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?=  $preFilled ? $bookToBeUpdated->getTitle()  : '' ?>" minlength="3" maxlength="144" required>

            <label for="author">Auteur</label>
            <input type="text" id="author" name="author" value="<?=  $preFilled ? $bookToBeUpdated->getAuthor()  : '' ?>" minlength="3" maxlength="32" required>

            <label for="description">Commentaire</label>
            <textarea name="description" id="description" minlength="50" maxlength="500" required><?=  $preFilled ? $bookToBeUpdated->getDescription() : '' ?></textarea>

            <label for="available">Disponibilité</label>
            <select name="available" id="available" required>
                <option value="">--Veuillez choisir un statut--</option>
                <option <?= $bookToBeUpdated->getAvailable() ? 'selected' : '' ?> value="1">Disponible</option>
                <option <?= !$bookToBeUpdated->getAvailable() ? 'selected' : '' ?> value="0">Non disponible</option>
            </select>

            <div class="error-box">
                <?php
                    if (isset($emptyError)) {
                        echo $emptyError;
                    } elseif (isset($formatError)) {
                        echo $formatError;
                    } elseif (isset($errors)) {
                        foreach ($errors as $error => $value) {
                            echo $value.'<br/>';
                        }
                    }
                ?>
            </div>

            <input type="submit" id="submit" value="Valider">
        </div>
    </form>
</section>
