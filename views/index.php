<?php
    session_set_cookie_params(172800);
    session_start();

    if(!empty($_SESSION) && $_SESSION['timeout'] <= time()) header('location: /logout');

    function isAllowed($level){
        try{
            if(empty($_SESSION)) throw new Exception(0);
            if($_SESSION['level'] < $level) throw new Exception(1);   
        }catch(Exception $e){
            switch ($e->getMessage()){
                case 0: 
                    header('location: /404');
                    break;
                case 1:
                    header('location: /505');
                    break;
            }
        }
    }
    
    function isAllowedToDisplay($level){
        try{
            if(empty($_SESSION)) throw new Exception(0);
            if($_SESSION['level'] < $level) throw new Exception(1);   
        }catch(Exception $e){
            return false;
        }
        return true;
    }

    global $route;
    $route = explode("/", substr($_SERVER['REQUEST_URI'],1));

    $view = $route[0];
    $subview = (isset($route[1])) ? $route[1] : "";
    $parameter = (isset($route[2])) ? $route[2] : "";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="PMP">
        <title>ESME - Gestion des congés</title>
        <link rel="shortcut icon" href="/media/img/logo.png" type="image/png">
        
        <link rel="stylesheet" href="/media/css/style.css">
    </head>
    <body>
        <?php include("components/header.php"); ?>
        <content>
            <article>
                <?php
                    switch($view){
                        case "":
                            include("home.php");
                        break;
                        case "home":
                            include("home.php");
                        break;
                        case "login":
                            include("authentificate/login.php");
                        break;
                        case "logout":
                            isAllowed(0);
                            session_destroy();
                            header("location: /home");
                        break;
                        case "gestionConges":
                            isAllowed(0);
                            include("gestionConges/index.php");
                        break;
                        case "gestionMessages":
                            isAllowed(0);
                            include("gestionMessages/index.php");
                        break;
                        case "gestionProfil":
                            isAllowed(0);
                            include("gestionProfil/index.php");
                        break;
                        case "gestionSalaries":
                            isAllowed(1);
                            include("gestionSalaries/index.php");
                        break;
                        case "505":
                            include("components/505.php");
                        break;
                        default:
                            include("components/404.php");
                        break;
                    }
                ?>
            </article>
        </content>
        <?php include("components/footer.php"); ?>
    </body>
</html>