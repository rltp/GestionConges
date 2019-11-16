<?php
    require_once("connector.php");
    function authentificate($email, $password, $isAdmin){
        global $con;

        if ($stmt = $con->prepare('SELECT id, password, firstname, function FROM `salarie` WHERE email = ? and isAdmin = ?')) {
            $stmt->bind_param('si', $email, $isAdmin);
            $stmt->execute();
            $stmt->store_result();
        }
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $pwd, $name, $function);
            $stmt->fetch();
            if (md5($password) == $pwd) {
                session_regenerate_id();
                $_SESSION['name'] = $name;
                $_SESSION['function'] = $function;
                $_SESSION['id'] = $id;
                $_SESSION['timeout'] = ($isAdmin) ? time() + 172800 : time() + 3600;
                $_SESSION['level'] = ($isAdmin) ? 1 : 0;
                $code = 1;
            } else {
                $code = 3;
            }
        } else {
            $code = 2;
        }

        $stmt->close();
        return $code;
    }
?>