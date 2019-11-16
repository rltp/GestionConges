<?php
    require_once("../../../core/connector.php");
    $route = explode("/", substr($_SERVER['REQUEST_URI'],1));
    $id = $route[3];
    $files = glob($_SERVER["DOCUMENT_ROOT"]."/media/upload/Pics/".$id.".*");
    if(!empty($files)){
        header("Content-type: image/".pathinfo($files[0])['extension']);
        header('Content-Description: Picture');
        header('Pragma: public');
        header('Content-Length: ' . filesize($files[0]));
        readfile($files[0]);
    }else{
        global $con;

        if (!$stmt = $con->prepare('SELECT lastname, firstname FROM `salarie` WHERE id = ?'))
            die("requete non valide");
        
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($lastname, $firstname);
        $stmt->fetch();
        $stmt->close();

        $firstname = (empty(($firstname))) ? "?" : $firstname;
        $lastname = (empty(($lastname))) ? "?" : $lastname;

        $initials =  preg_split("/[\s,_-]+/", $firstname." ".$lastname);
        $string = "";
        foreach ($initials as $i) $string .= $i[0];

        $img = imagecreate( 200, 200 );
        $background = imagecolorallocate( $img,rand(0, 200), rand(0, 200), rand(0, 200) );
        $text_colour = imagecolorallocate( $img, 255, 255, 255 );
        $font = realpath($_SERVER['DOCUMENT_ROOT']."/media/font/font.ttf");
        imagettftext($img, 110, 0, 25, 130, $text_colour, $font, $string);
        header( 'Content-type: image/png' );
        imagepng( $img );
        imagecolordeallocate( $img, $text_colour );
        imagecolordeallocate( $img, $background );
        imagedestroy( $img );
    }
?>