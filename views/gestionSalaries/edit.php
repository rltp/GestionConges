<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><?php foreach($errors as $e) echo $e;?></div>
<?php } ?>

<?php if(!empty($_POST) && empty($errors)) {?>
    <div class="messagebox success">Compte modifié</div>
<?php } ?>

<form action="" method="post" enctype="multipart/form-data">
    <h2>Edition d'un salarié</h2>
    <fieldset>
        <legend>Obligatoire</legend>
        <span>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="ex : Doe" value="<?= $infos['lastname']?>">
        </span>
        <span>
            <label for="firstname">lastname</label>
            <input type="text" name="firstname" id="firstname" placeholder="ex : Jean" value="<?= $infos['firstname']?>">
        </span>
        <span>
            <label for="phone">Numero de telephone</label>
            <input type="phone" name="phone" id="phone" placeholder="ex : Jean" value="0<?= $infos['phone']?>">
        </span>
        <span>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $infos['email']?>">
        </span>
        <span>
            <label for="function">Fonction</label>
            <select name="function" id="function">
                <option value="" style="color: #757575">Veuillez selectionner la function</option>
                <option value="E" <?= ($infos['function'] == 'S') ? "selected" : "" ?>>Enseignant</option>
                <option value="P" <?= ($infos['function'] == 'P') ? "selected" : "" ?>>Personnel administratif</option>
            </select>
        </span>
        <span>
            <label for="contract">Type de contrat</label>
            <select name="contract" id="contract">
                <option value="" style="color: #757575">Veuillez selectionner le type de contrat</option>
                <option value="CDD" <?= ($infos['contract'] == 'CDD') ? "selected" : "" ?>>CDD</option>
                <option value="CDI" <?= ($infos['contract'] == 'CDI') ? "selected" : "" ?>>CDI</option>
            </select>
        </span>
    </fieldset>
    <fieldset>
        <legend>Facultatif</legend>
        <span>
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="ex : 92201, Gagny, 123 avenue sesame" value="<?= $infos['address']?>">
        </span>
        <span>
            <label for="situation">Situation</label>
            <select name="situation" id="situation">
                <option value="" style="color: #757575">Veuillez selectionner votre situation</option>
                <option value="alone" <?= ($infos['situation'] == 'alone') ? "selected" : "" ?>>Célibataire</option>
                <option value="married" <?= ($infos['situation'] == 'married') ? "selected" : "" ?>>Marié</option>
                <option value="concubinage" <?= ($infos['situation'] == 'concubinage') ? "selected" : "" ?>>En concubinage</option>
            </select>
        </span>
        <span>
            <label for="birthday">Date de naissance</label>
            <input type="text" name="birthday" id="birthday" value="<?= $infos['birthday']?>">
        </span>
        <span>
            <label for="cv">CV</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000000000" />
            <input type="file" name="cv" id="cv">
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>