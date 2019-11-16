<img class="profile-pic" src="/media/upload/Pics/<?= $value['id'] ?>"\>
<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Telephone</th>
            <th>Fonction</th>
            <th>Type de contrat</th>
            <th>Date d'embauche</th>
            <th>Adresse</th>
            <th>Nationalité</th>
            <th>Genre</th>
            <th>Situation familiale</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $value['email']?></td>
            <td><?= $value['lastname']?></td>
            <td><?= $value['firstname']?></td>
            <td>0<?= $value['phone']?></td>
            <td><?= ($value['function'] == "E") ? "Personnel administratif" : "Enseignant"?></td>
            <td><?= $value['contract']?></td>
            <td><?= $value['date']?></td>
            <td><?= (empty($value['address'])) ? "<u>Aucun</u>" : $value['address']?></td>
            <td><?= (empty($value['nationality'])) ? "<u>Aucun</u>" : $value['nationality']?></td>
            <td><?= (empty($value['sexe'])) ? "<u>Aucun</u>" : ($value['sexe'] == "male") ? "Homme" : "Femme" ?></td>
            <td><?= (empty($value['situation'])) ? "<u>Aucun</u>" : $value['situation']?></td>
            <td><?= (empty($value['birthday'])) ? "<u>Aucun</u>" : $value['birthday']?></td>
        </tr>
    </tbody>
</table>