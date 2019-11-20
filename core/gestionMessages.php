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

    function addComment($id, $message, $toID=1){
        global $con;
        $stmt;
        
        try{
            if(!$stmt = $con->prepare("INSERT INTO Comments (toID, fromID, comment, date, seen) VALUES(?, ?, ?, NOW(), 0)")) throw new Exception("Requete non valide");
            $stmt->bind_param('iis', $toID, $id, $message);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    function getTalks($id){
        global $con;

        if (!$stmt = $con->prepare('SELECT Z.id, Z.win as fromID, Z.seen FROM (SELECT id, fromID as win, seen FROM `comments` WHERE fromID != ? AND toID = ? UNION SELECT id, toID as win, seen FROM `comments` WHERE fromID = ? AND toID != ?) AS Z GROUP BY Z.win ORDER BY Z.id DESC, Z.seen ASC'))
            die("requete non valide");
        
        $stmt->bind_param('iiii', $id, $id, $id, $id);
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

        if(!empty($result)) return $result;
    }

    function getComments($user1, $user2){
        global $con;

        if (!$stmt = $con->prepare('SELECT id, toID, fromID, comment, seen, date FROM `comments` WHERE (toID = ? AND fromID = ?) OR (toID = ? AND fromID = ?) ORDER BY id ASC'))
            die("requete non valide");
        
        $stmt->bind_param('iiii', $user1, $user2, $user2, $user1);
        $stmt->execute();
        $stmt->store_result();
        $meta = $stmt->result_metadata(); 

        while ($field = $meta->fetch_field()) {$params[] = &$row[$field->name];}

        call_user_func_array(array($stmt, 'bind_result'), $params); 

        while ($stmt->fetch()) { 
            foreach($row as $key => $val) $c[$key] = $val;
            seen($c['id'], $user2);
            $result[] = $c; 
        } 
        $stmt->close();

        if(!empty($result)) return $result;
    }

    function seen($id, $fromID){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("UPDATE Comments SET seen = 1 WHERE id = ? AND seen = 0 AND fromID != ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('ii', $id, $fromID);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    function countUnseenComment($id, $from){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("SELECT count(id) FROM `comments` WHERE toID = ? and seen=0 and cast(fromID as char) like ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('is', $id, strval($from));
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            $stmt->bind_result($count);
            $stmt->fetch();
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
            return $count;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    function removeComment($id){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("DELETE FROM `comments` WHERE id= ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('i', $id);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            $stmt->close();
        }catch(Exception $e){
            return false;
        }
        return true;
    }

?>