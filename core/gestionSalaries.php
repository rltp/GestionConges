<?php
    require_once("connector.php");
    require_once("args.php");

    function addSalaried($infos){
        global $con;
        $stmt;
        $table = "id,isAdmin,password";
        $value = "null,0,null";

        foreach($infos as $key => $val){
            $table .= ",".$key;
            $value .= ",'".$val."'";
        }

        try{
            if(!$stmt = $con->prepare("INSERT INTO `salarie` ( ".$table." ) VALUES (".$value.")")) throw new Exception("Requete non valide");
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            $stmt->close();
        }catch(Exception $e){
            return $e->getMessage();
        }
        return;
    }

    function editSalaried($id, $infos){
        global $con;
        $stmt;

        $array = [];
        foreach($infos as $key => $val) array_push($array, $key."='".$val."'");
        $value = implode(",", $array);
        
        try{
            if(!$stmt = $con->prepare("UPDATE `salarie` SET ".$value." WHERE id= ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('i', $id);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            $stmt->close();
        }catch(Exception $e){
           return $e->getMessage();
        }
        return;
    }

    function removeSalaried($id){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("DELETE FROM `salarie` WHERE id= ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('i', $id);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
        }catch(Exception $e){
            return false;
        }
        return true;
    }

    function getSalaried($id){
        global $con;
        $stmt;

        if (!$stmt = $con->prepare('SELECT * FROM `salarie` WHERE id = ?')) die("requete non valide");
        
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $meta = $stmt->result_metadata(); 

        while ($field = $meta->fetch_field()) {$params[] = &$row[$field->name];}

        call_user_func_array(array($stmt, 'bind_result'), $params); 

        while ($stmt->fetch()) { 
            foreach($row as $key => $val) $c[$key] = $val;
            $result[] = $c; 
        } 
        $stmt->close();
        if(!empty($result)) return $result[0];
    }
    
    function getAllSalarieds(){
        global $con;
        static$stmt;

        if (!$stmt = $con->prepare('SELECT id, email, lastname, firstname, function, contract FROM `salarie` WHERE id != ?')) die("requete non valide");
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->store_result();
        $meta = $stmt->result_metadata(); 

        while ($field = $meta->fetch_field()) {$params[] = &$row[$field->name];}

        call_user_func_array(array($stmt, 'bind_result'), $params); 

        while ($stmt->fetch()) { 
            foreach($row as $key => $val) $c[$key] = $val; 
            $result[] = $c; 
        }
        $stmt->close();
        return $result;
    }

    function upload($file, $name, $path, $allowedMimeTypes){
        try {
            if (empty($file)) throw new Exception('Le fichier est manquant');
            
            if ($file['error'] !== 0) {
                if ($file['error'] === 1) 
                    throw new Exception('La taille max du fichier est excedé');
                    
                throw new Exception('Erreur du fichier INI');
            }

            if ($file['size'] >  2 * 10e6) throw new Exception('La taille max du fichier est excedé'); 
            
            if (!filesize($file['tmp_name'])) throw new Exception('Fichier invalide');
            if (!in_array($file['type'], $allowedMimeTypes)) throw new Exception('Type de fichier non autorisé');
            
            $fileExtention = strtolower(pathinfo($file['name'] ,PATHINFO_EXTENSION));
            $fileName = $name. '.' . $fileExtention;
            $destination = $_SERVER['DOCUMENT_ROOT'] . $path . $fileName;
        
            if(!empty($files = glob($_SERVER["DOCUMENT_ROOT"]."/media/upload/Pics/".$name.".*"))) unlink($files[0]);
            if (!move_uploaded_file($file['tmp_name'], $destination)) throw new Exception('Le fichier non deplacé'); 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
?>