<aside>
    <?php if(!isAllowedToDisplay(1)) {?><a href="/gestionConges/liste" <?= ($subview == "liste") ? "active": "" ?>>Liste des congés</a><?php } ?>
    <?php if(!isAllowedToDisplay(1)) {?><a href="/gestionConges/ajout" <?= ($subview == "ajout") ? "active": "" ?>>Ajout d'un congé</a><?php } ?>
    <?php if(isAllowedToDisplay(1)) {?><a href="/gestionConges/valider" <?= ($subview == "valider" || $subview == "voir") ? "active": "" ?>>Valider congé</a><?php } ?>
</aside>
<section>
    <?php
        include("../core/gestionConges.php");
        switch($subview){
            case "":
                if($_SESSION['level']) header("location: /gestionConges/valider");
                else header("location: /gestionConges/liste");
            break;
            case "liste":
                if($_SESSION['level']) header("location: /gestionConges/valider");
                include("list.php");
                break;
            case "ajout":
                if($_SESSION['level']) header("location: /gestionConges/valider");
                if(isset($_POST['typeConge'], $_POST['startDay'],$_POST['endDay'])){
                    $errors = array();
                    $edit_args =  array_intersect_key($args, array_flip(array('typeConge', 'startDay', 'endDay')));
                    $_POST = array_map('trim', $_POST);
                    $_POST = array_map('strip_tags', $_POST);
                    $_POST =  array_intersect_key($_POST, array_flip(array('typeConge', 'startDay', 'endDay')));
                    foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                    foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                    if(empty($errors)) if(($check = checkConge($_SESSION['id'], $data['startDay'], $data['endDay'], $data['typeConge'])) !== true) array_push($errors, $check);
                    if(empty($errors)) if(($sql = addConge($_SESSION['id'], $data['typeConge'], $data['startDay'], $data['endDay'])) !== null && !is_int($sql)) array_push($errors, $sql);
                    if(empty($errors)) addComment($_SESSION['id'], "[{$data['typeConge']}] Demande de congé du {$data['startDay']} au {$data['endDay']}<br/><a href='/gestionConges/voir/{$sql}'>Consulter</a>");
                }
                $infos = getInfos($_SESSION['id']);
                include("add.php");
                break;
            case "voir":
                if(empty($parameter)) header("location: /home");
                if($_SESSION['level']){
                    $infos = getCongeInfos($parameter);
                    if(isset($_POST['status'])){
                        $errors = array();
                        $edit_args =  array_intersect_key($args, array_flip(array('status', 'message')));
                        $_POST = array_map('trim', $_POST);
                        $_POST = array_map('strip_tags', $_POST);
                        $_POST =  array_intersect_key($_POST, array_flip(array('status', 'message')));
                        foreach($_POST as $key => $value) if(empty($value)) unset($_POST[$key]);
                        foreach(($data = filter_var_array($_POST, $edit_args)) as $key => $value) if($value === false) array_push($errors, $edit_args[$key]["error"]);
                        if(empty($errors)) if(($sql = updateConge($parameter, $data['status'])) !== null && !is_int($sql)) array_push($errors, $sql);
                        if(empty($errors)){
                            $status = ($data['status'] === 1) ? "Refus" : "Acceptation";
                            $message = empty($data['message'])? "" : "{$data['message']}<br/>";
                            addComment($_SESSION['id'], $status." du {$infos['type']} pour le {$infos['start']} au {$infos['end']}<br/>$message<a href='/gestionConges/voir/{$parameter}'>Consulter</a>", $infos['id']);
                        }
                        $infos['status'] = $data['status'];
                    }
                    include('validate_form.php');
                } else {
                    $date = explode('-', getCongeFromID($parameter)['start']);
                    header("location: /gestionConges/liste/{$date[2]}/{$date[1]}");
                }
            break;
            case "valider":
                if(!$_SESSION['level']) header("location: /gestionConges/liste");
                include("validate.php");
                break;
            default:
                include("components/404.php");
                break;
        }
    ?>
</section>