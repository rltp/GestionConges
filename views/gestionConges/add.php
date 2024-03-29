<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><u>Erreur :</u><ul><?php foreach($errors as $e) echo "<li>".$e."</li>"; ?></ul></div>
<?php } ?>

<?php if(!empty($_POST) && isset($errors) && empty($errors)) {?>
    <div class="messagebox success">Congé ajouté</div>
<?php } ?>

<form method="post">
    <fieldset>
        <legend>Ajout d'un congé</legend>
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
            <label for="type">Type de congé</label>
            <span id="type" style="display:inline;">
                <input type="radio" name="typeConge" id="CP" value="CP">
                <label for="CP">CP</label>
                <input type="radio" name="typeConge" id="RTT" value="RTT">
                <label for="RTT">RTT</label>
            </span>     
        </span>
        <span>
            <label for="startday">Date de début</label>
            <input type="text" name="startDay" id="startDay" placeholder="ex: 15-09-2020">
        </span>
        <span>
            <label for="endday">Date de fin</label>
            <input type="text" name="endDay" id="endDay" placeholder="ex: 15-09-2020">
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>