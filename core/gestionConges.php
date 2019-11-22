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

    function checkConge($id, $start, $end, $type){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("SELECT * FROM conges WHERE salaried=? AND STR_TO_DATE(?, '%d-%m-%Y') < STR_TO_DATE(end, '%d-%m-%Y') AND STR_TO_DATE(?, '%d-%m-%Y') > STR_TO_DATE(start, '%d-%m-%Y')")) throw new Exception("Requete non valide");
            $stmt->bind_param('iss', $id, $start, $end);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            if($stmt->fetch()) throw new Exception("Congé déjà posé durant cette période");
            $stmt->close();

            if(!$stmt = $con->prepare("SELECT (s.RTT - MAX(CASE WHEN c.type = 'RTT' THEN c.diff ELSE NULL END)) AS RTT, (s.CP - MAX(CASE WHEN c.type = 'CP' THEN c.diff ELSE NULL END)) AS CP FROM (SELECT SUM(DATEDIFF(STR_TO_DATE(end, '%d-%m-%Y'), STR_TO_DATE(start, '%d-%m-%Y'))) as diff, type, salaried FROM conges WHERE salaried=? AND status !=1 GROUP BY type) as c JOIN salarie AS s ON s.id = c.salaried GROUP BY c.salaried")) throw new Exception("Requete non valide");
            $stmt->bind_param('i', $id);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            $meta = $stmt->result_metadata(); 

            while ($field = $meta->fetch_field()) {$params[] = &$row[$field->name];}
    
            call_user_func_array(array($stmt, 'bind_result'), $params); 
    
            while ($stmt->fetch()) { 
                foreach($row as $key => $val) $c[$key] = $val;
                $result[] = $c; 
            }

            if(intval($result[0][$type]) < date_diff(date_create($start), date_create($end))->days)
                throw new Exception("Vous n'avez pas assez de ".$type);
            $stmt->close();
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }
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

    function addConge($id, $type, $start, $end){
        global $con;
        $stmt;
        try{
            if(!$stmt = $con->prepare("INSERT INTO Conges (salaried, type, date, start, end, status) VALUES(?, ?, NOW(), ?, ?, 0)")) throw new Exception("Requete non valide");
            $stmt->bind_param('isss', $id, $type, $start, $end);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            if($stmt->affected_rows == 0) throw new Exception("Aucune ligne affecté");
            return $stmt->insert_id;
            $stmt->close();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    function getCongeFromSalaried($id){
        global $con;

        if (!$stmt = $con->prepare('SELECT * FROM `conges` WHERE salaried = ?'))
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

        if(!empty($result)) return $result;
    }

    function getAllConge(){
        global $con;

        if (!$stmt = $con->prepare('SELECT * FROM `conges` '))
            die("requete non valide");
        
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

    function getCongeFromID($id){
        global $con;

        if (!$stmt = $con->prepare('SELECT start FROM `conges` WHERE id = ?'))
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

    function getCongeInfos($id){
        global $con;

        if (!$stmt = $con->prepare("SELECT s.id, c.type, c.start, c.date, c.end, c.status, s.email, s.lastname, s.firstname, (DATEDIFF(STR_TO_DATE(c.end, '%d-%m-%Y'), STR_TO_DATE(c.start, '%d-%m-%Y')) + 1) as datediff FROM conges c join salarie s ON c.salaried = s.id WHERE c.id = ?"))
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

    function getCongesFromDate($date){
        global $con;

        if (!$stmt = $con->prepare("SELECT *, (DATEDIFF(STR_TO_DATE(end, '%d-%m-%Y'), STR_TO_DATE(start, '%d-%m-%Y')) + 1) as diff FROM `conges` WHERE STR_TO_DATE(start, '%d-%m-%Y') <= STR_TO_DATE(?, '%d-%m-%Y') AND STR_TO_DATE(end, '%d-%m-%Y') >= STR_TO_DATE(?, '%d-%m-%Y') ORDER BY status, date"))
            die("requete non valide");
        
        $stmt->bind_param('ss', $date, $date);
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


    function getCongesFromMonth($month){
        global $con;

        $date = "%-".$month;

        if (!$stmt = $con->prepare("SELECT *, (DATEDIFF(STR_TO_DATE(end, '%d-%m-%Y'), STR_TO_DATE(start, '%d-%m-%Y')) + 1) as diff 
                                    FROM `conges` WHERE  start LIKE ? OR end LIKE ? ORDER BY status, date"))
            die("requete non valide");
        
        $stmt->bind_param('ss', $date, $date);
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

    function updateConge($id, $status) {
        global $con;

        $array = [];

        try{
            if(!$stmt = $con->prepare("UPDATE `conges` SET status = ? WHERE id= ?")) throw new Exception("Requete non valide");
            $stmt->bind_param('ii', $status, $id);
            if(!$stmt->execute()) throw new Exception("Requete non executé");
            $stmt->close();
        }catch(Exception $e){
           return $e->getMessage();
        }
        return;
    }

    function date_range($first, $last, $step) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
    
        while( $current <= $last ) {
    
            $dates[] = date('d-m-Y', $current);
            $current = strtotime($step, $current);
        }
    
        return $dates;
    }
?>