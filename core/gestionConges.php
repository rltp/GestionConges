<?php
    require_once("connector.php");
    require_once("args.php");


    function getInfos($id){
        global $con;

        if (!$stmt = $con->prepare('SELECT email, lastname, firstname FROM `salarie` WHERE id = ?'))
            die("requete non valide");
        
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

        if(!empty($result[0])) return $result[0];
    }

    function addConge($id, $type, $start, $end){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("INSERT INTO Conges (salaried, type, date, start, end, status) VALUES(?, ?, NOW(), ?, ?, 0)")) throw new Exception("Requete non valide");
            $stmt->bind_param('isss', $id, $type, $start, $end);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
?>