<aside>
    <a href="/gestionProfil" <?= ($subview == "") ? "active": "" ?>>Profil</a>
    <a href="/gestionProfil/modifier" <?= ($subview == "modifier") ? "active": "" ?>>Modifier</a>
</aside>
<section>
    <?php
        include("../core/gestionProfil.php");
        switch($subview){
            case "":
                $value = getProfile($_SESSION['id']);
                include("infos.php");
                break;
            case "modifier":
                if(isset($_POST['lastname'], $_POST['firstname'], $_POST['phone'])){
                    $errors = array();
                    $edit_args =  array_intersect_key($args, array_flip(array('lastname', 'firstname','phone', 'situation', 'address', 'birthday', 'password')));
                    $_POST = array_map('trim', $_POST);
                    $_POST = array_map('strip_tags', $_POST);
                    $_POST =  array_intersect_key($_POST, array_flip(array('lastname', 'firstname','phone', 'situation', 'address', 'birthday', 'password')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    if(empty($errors) && isset($data['password'])) if(!isUniqPassword(MD5($data['password']))) array_push($errors, "Le mot de passe n'est pas unique"); else $data['password'] = md5($data['password']);
                    if(empty($errors)) if(($sql = editProfile($_SESSION['id'], $data))!==null) array_push($errors, $sql);
                }
                $infos = getProfile($_SESSION['id']);
                if(!empty($_FILES)) if($_FILES['pic']['error']!==4) if(($pic = upload($_FILES["pic"], $infos['id'], "/media/upload/Pics/", ['image/jpeg', 'image/png', 'image/gif'])) !== null) array_push($errors, $pic);
                
                include("edit.php");
                break;
            default:
                include("components/404.php");
                break;
        }
    ?>
</section>