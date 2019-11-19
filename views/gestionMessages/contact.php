<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><u>Erreur :</u><ul><?php foreach($errors as $e) echo "<li>".$e."</li>"; ?></ul></div>
<?php } ?>

<?php if(!empty($_POST) && empty($errors)) {?>
    <div class="messagebox success">Message envoyé</div>
<?php } ?>

<form method="post">
    <fieldset>
        <legend>Ajout d'un message au directeur</legend>
        <span>
            <label>
                <u>Prenom :</u>
                <?= $infos['firstname']; ?>
            </label>
        </span>
        <span>
            <label>
                <u>Nom :</u>
                <?= $infos['lastname']; ?>
            </label>
        </span>
        <span>
            <label>
                <u>Email :</u>
                <?= $infos['email']; ?>
            </label>
        </span>
        <span>
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="10" style="width: 100%;"></textarea>
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>