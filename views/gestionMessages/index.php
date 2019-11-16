<?php
    include("../core/gestionMessages.php");
?>
<aside>
    <a href="/gestionMessages/consultation" <?= ($subview == "" || $subview == "consultation") ? "active": "" ?>>
        Consultation
        <?php if(($pop = countUnseenComment($_SESSION['id'], '%'))) echo "<pop>".$pop."</pop>"; ?>
    </a>
    <?php if(!$_SESSION['level']) {?><a href="/gestionMessages/contact" <?= ($subview == "contact") ? "active": "" ?>>Contact</a><?php } ?>
</aside>
<section>
    <?php
        switch($subview){
            case "":
            case "consultation":
                $errors = array();
                if(isset($_POST['message'], $_POST['toID'])){
                    $edit_args =  array_intersect_key($args, array_flip(array('message', 'toID')));
                    $_POST =  array_intersect_key($_POST, array_flip(array('message', 'toID')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    if(empty($errors)) if(($sql = addComment($_SESSION['id'], $data['message'], $data['toID'])) !== null) array_push($errors, $sql);
                }
                if(isset($_POST['remove']) && $_SESSION['level']) removeComment($_POST['remove']);
                $talks = getTalks($_SESSION['id']);
                include("consultation.php");
                break;
            case "contact":
                if($_SESSION['level']) header("location: /gestionMessages/consultation");
                $errors = array();
                if(isset($_POST['message'])){
                    $edit_args =  array_intersect_key($args, array_flip(array('message')));
                    $_POST =  array_intersect_key($_POST, array_flip(array('message')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    if(empty($errors)) if(($sql = addComment($_SESSION['id'], $data['message'])) !== null) array_push($errors, $sql);
                }
                $infos = getInfos($_SESSION['id']);

                include("contact.php");
                break;
            default:
                include("components/404.php");
                break;
        }
    ?>
</section>