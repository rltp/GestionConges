<aside>
    <a href="/gestionSalaries" <?= ($subview == "") ? "active": "" ?>>Liste des salariés</a>
    <a href="/gestionSalaries/ajout" <?= ($subview == "ajout") ? "active": "" ?>>Ajout d'un salarié</a>
</aside>
<section>
    <?php
        include("../core/gestionSalaries.php");
        switch($subview){
            case "ajout":
                $errors = array();

                if(isset($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['phone'], $_POST['function'], $_POST['contract'], $_POST['date'], $_POST['RTT'], $_POST['CP'])){
                    $edit_args =  array_intersect_key($args, array_flip(array('lastname', 'firstname', 'email', 'phone', 'function', 'contract', 'date', 'RTT', 'CP', 'situation', 'address', 'sexe', 'nationality', 'birthday')));
                    $_POST =  array_intersect_key($_POST, array_flip(array('lastname', 'firstname', 'email', 'phone', 'function', 'contract', 'date', 'RTT', 'CP', 'situation', 'address', 'sexe', 'nationality', 'birthday')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    $isCDI = (date_diff(date_create($data['date']), date_create(date("d-m-y")))->days >30);
                    var_dump(date_diff(date_create($data['date']), date_create(date("d-m-y"))));
                    if(!$isCDI && $data['contract'] == "CDD" && $data['CP']>0) array_push($errors, "CP trop important pour un CDD en période d'essai");
                    if($isCDI && $data['function'] == "E" && $data['RTT']>10) array_push($errors, "RTT trop important pour un enseignant");
                    if($isCDI && $data['function'] == "P" && $data['RTT']>5) array_push($errors, "RTT trop important pour un personnel administratif");
                    if(empty($errors)) if(($sql = addSalaried($data)) !== null) array_push($errors, $sql);
                }

                include("add.php");
                break;
            case "modifier":
                if($_SESSION['id'] == $parameter) header("location: /gestionSalaries");

                if(isset($_POST['lastname'], $_POST['firstname'], $_POST['phone'], $_POST['function'], $_POST['contract'])){
                    $errors = array();
                    $edit_args =  array_intersect_key($args, array_flip(array('lastname', 'firstname','phone', 'function', 'contract', 'situation', 'address', 'birthday')));
                    $_POST =  array_intersect_key($_POST, array_flip(array('lastname', 'firstname','phone', 'function', 'contract', 'situation', 'address', 'birthday')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    if(empty($errors)) if(($sql = editSalaried($parameter, $data))!==null) array_push($errors, $sql);
                }

                $infos = getSalaried($parameter);
                if(!empty($_FILES)) if($_FILES['cv']['error']!==4) 
                if(($cv = upload($_FILES["cv"], $infos['id'], "/media/upload/CVs/", ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) !== null)
                    array_push($errors, $cv);


                include("edit.php");
                break;
            case "":
                $messages = array();
                if(!empty($_POST)) foreach($_POST as $id => $email) {
                    $messages[$id] = removeSalaried($id);
                    if(!empty(($f = glob($_SERVER['DOCUMENT_ROOT']."/media/upload/Pics/".$id.".*"))))
                        unlink($f[0]);
                        
                    if(!empty(($f = glob($_SERVER['DOCUMENT_ROOT']."/media/upload/CVs/".$id.".*"))))
                        unlink($f[0]);
                }
                include("list.php");
                break;
            default:
                include("components/404.php");
                break;
        }
    ?>
</section>