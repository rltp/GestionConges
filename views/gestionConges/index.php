<aside>
    <a href="/gestionConges" <?= ($subview == "") ? "active": "" ?>>Liste des congés</a>
    <a href="/gestionConges/ajout" <?= ($subview == "ajout") ? "active": "" ?>>Ajout d'un congé</a>
    <?php if(isAllowedToDisplay(1)) {?><a href="/gestionConges/valider" <?= ($subview == "valider") ? "active": "" ?>>Valider congé</a><?php } ?>
</aside>
<section>
    <?php
        include("../core/gestionConges.php");
        switch($subview){
            case "":
                include("list.php");
                break;
            case "ajout":
                $infos = getInfos($_SESSION['id']);
                include("add.php");
                break;
            case "valider":
                //+ commentaires
                isAllowed(1);
                include("validate.php");
                break;
            default:
                include("components/404.php");
                break;
        }
    ?>
</section>