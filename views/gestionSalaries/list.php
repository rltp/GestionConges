<?php if(!empty($_POST) && empty(array_filter($messages))) {?>
    <div class="messagebox error"><u>Erreur :</u><ul><?php foreach($messages as $key =>$m) if(!$m) echo "<li>".$_POST[$key]."</li>"; ?></ul></div>
<?php } ?>

<?php if(!empty($_POST) && !empty(array_filter($messages))) {?>
    <div class="messagebox success"><u>Success :</u><ul><?php foreach($messages as $key =>$m) if($m) echo "<li>".$_POST[$key]."</li>"; ?></ul></div>
<?php } ?>

<form action="" method="post">
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Fonction</th>
                <th>Type de contrat</th>
                <th>CV</th>
                <th>Modification</th>
                <th>Suppression</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach(getAllSalarieds() as $value){
            ?>
            <tr>
                <td><img class="pic" src="/media/upload/Pics/<?= $value['id'] ?>" width="50" height="50"\></td>
                <td><?= $value['email']?></td>
                <td><?= $value['lastname']?></td>
                <td><?= $value['firstname']?></td>
                <td><?= ($value['function'] == "P") ? "Personnel administratif" : "Enseignant"?></td>
                <td><?= $value['contract']?></td>
                <td>
                    <?php if(!empty(glob($_SERVER["DOCUMENT_ROOT"]."/media/upload/CVs/".$value['id'].".*"))){ ?>
                        <a href="/media/upload/CVs/<?= $value['id']?>">Lien</a>
                    <?php }else echo "Aucun"; ?>
                </td>
                <td><a href="/gestionSalaries/modifier/<?= $value['id']?>">Modifier</a></td>
                <td><input type="checkbox" name="<?= $value['id']?>" value="<?= $value['email']?>"\></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td><button style="background: #dc3545; border-color:#dc3545!important"><img src="/media/img/trash.svg" alt="Supprimer" style="width: 15px;filter: invert(1);"></button></td>
            </tr>
        </tbody>
    </table>
</form>