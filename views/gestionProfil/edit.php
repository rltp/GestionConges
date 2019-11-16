<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: none;
    overflow: auto;
    background-color: #000000;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
}

.modal-window {
    position: relative;
    background-color: #FFFFFF;
    width: 50%;
    margin: 10% auto;
    padding: 20px;
}

.modal-window.small {
    width: 30%;
}

.modal-window.large {
    width: 75%;
}

.close {
    position: absolute;
    top: 0;
    right: 0;
    color: rgba(0,0,0,0.3);
    height: 30px;
    width: 30px;
    font-size: 30px;
    line-height: 30px;
    text-align: center;
}

.close:hover,
.close:focus {
    color: #000000;
    cursor: pointer;
}

.open {
    display: block;
}
</style>

<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><?php foreach($errors as $e) echo $e;?></div>
<?php } ?>

<?php if(!empty($_POST) && empty($errors)) {?>
    <div class="messagebox success">Profil modifié</div>
<?php } ?>

<form action="" method="post" enctype="multipart/form-data">
    <h2>Edition du profil</h2>
    <fieldset>
        <legend>Obligatoire</legend>
        <span>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="ex : Doe" value="<?= $infos['lastname']?>">
        </span>
        <span>
            <label for="firstname">Prenom</label>
            <input type="text" name="firstname" id="firstname" placeholder="ex : Jean" value="<?= $infos['firstname']?>">
        </span>
        <span>
            <label for="phone">Numero de telephone</label>
            <input type="phone" name="phone" id="phone" placeholder="ex : Jean" value="0<?= $infos['phone']?>">
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
            <label for="pic">Photo de profil</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000000000" />
            <input type="file" name="pic" id="pic"  data-toggle="modal" data-target="picture_modal">
        </span>
    </fieldset>
    <span>
        <input type="submit" value="Envoyer">
    </span>
</form>
<div id="picture_modal" class="modal">
    <div class="modal-window">
        <h3>Resizing</h3>
        <button data-dismiss="modal">Continuer</button>
    </div>
</div>
<script type="application/javascript" src="/media/js/modal.js"></script>