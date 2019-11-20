<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><u>Erreur :</u><ul><?php foreach($errors as $e) echo "<li>".$e."</li>"; ?></ul></div>
<?php } ?>

<?php if(!empty($_POST) && isset($errors) && empty($errors)) {?>
    <div class="messagebox success">Congé modifié</div>
<?php } ?>

<form method="post">
    <fieldset>
        <legend>Valideation du <?= $infos['type']; ?></legend>
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
            <label>
                <u>Date d'envoie :</u>
                <?= $infos['date']; ?>
            </label>
        </span>
        <span>
            <label>
                <u>Nombre de jours :</u>
                <?= $infos['end']; ?>
            </label>
        </span>
        <span>
            <label>
                <u>Date de début :</u>
                <?= $infos['start']; ?>
            </label>
        </span>
        <span>
            <label>
                <u>Date de fin :</u>
                <?= $infos['end']; ?>
            </label>
        </span>
        <span>
            <label for="type">Statut</label>
            <span id="type" style="display:inline;">
                <input type="radio" name="status" id="allowed" value="2" <?= ($infos['status']===1)? "checked" : ""?>>
                <label for="allowed">Accepter</label>
                <input type="radio" name="status" id="denied" value="1" <?= ($infos['status']===2)? "checked" : ""?>>
                <label for="denied">Refuser</label>
            </span>     
        </span>
        <span>
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="10" style="width: 100%;" placeholder="(Facultatif)"></textarea>
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>