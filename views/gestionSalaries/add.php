<?php if(!empty($_POST) && !empty($errors)) { ?>
    <div class="messagebox error"><?php foreach($errors as $e) echo $e;?></div>
<?php } ?>

<?php if(!empty($_POST) && empty($errors)) {?>
    <div class="messagebox success">Compte crée</div>
<?php } ?>

<form method="post">
    <h2>Ajout salarié</h2>
    <fieldset>
        <legend>Obligatoire</legend>
        <span>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="ex : Doe" value="Doe">
        </span>
        <span>
            <label for="firstname">Prenom</label>
            <input type="text" name="firstname" id="firstname" placeholder="ex : Jean" value="Jean">
        </span>
        <span>
            <label for="phone">Numero de telephone</label>
            <input type="phone" name="phone" id="phone" placeholder="ex : Jean" value="0659874596">
        </span>
        <span>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="jean.doe.<?=rand(1, 2000)?>@esme.fr">
        </span>
        <span>
            <label for="function">Fonction</label>
            <select name="function" id="function">
                <option value="" style="color: #757575">Veuillez selectionner la function</option>
                <option value="E" selected>Enseignant</option>
                <option value="P">Personnel administratif</option>
            </select>
        </span>
        <span>
            <label for="contract">Type de contrat</label>
            <select name="contract" id="contract">
                <option value="" style="color: #757575">Veuillez selectionner le type de contrat</option>
                <option value="CDD" selected >CDD</option>
                <option value="CDI">CDI</option>
            </select>
        </span>
        <span>
            <label for="date">Date d'embauche</label>
            <input type="text" name="date" id="date" value="2006-06-19">
        </span>
        <span>
            <label for="RTT">Nombre de congés restant RTT</label>
            <input type="text" name="RTT" id="RTT" value="12">
        </span>
        <span>
            <label for="CP">Nombre de congés restant payé</label>
            <input type="text" name="CP" id="CP" value="15">
        </span>
    </fieldset>
    <fieldset>
        <legend>Facultatif</legend>
        <span>
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="ex : 92201, Gagny, 123 avenue sesame lolo" value="92201, Gagny, 123 avenue sesame">
        </span>
        <span>
            <label for="nationality">Nationalité</label>
            <input type="text" name="nationality" id="nationality" placeholder="ex : Française" value="Française">
        </span>
        <span>
            <label for="sexe">Genre</label>
            <select name="sexe" id="sexe">
                <option value="" style="color: #757575">Veuillez selectionner votre sexe</option>
                <option value="female" selected>Femme</option>
                <option value="male">Homme</option>
                <option value="none">Non gendré</option>
            </select>
        </span>
        <span>
            <label for="situation">Situation</label>
            <select name="situation" id="situation">
                <option value="" style="color: #757575">Veuillez selectionner votre situation</option>
                <option value="alone" selected>Célibataire</option>
                <option value="married">Marié</option>
                <option value="concubinage">En concubinage</option>
            </select>
        </span>
        <span>
            <label for="birthday">Date de naissance</label>
            <input type="text" name="birthday" id="birthday" value="1988-06-19">
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>