<?php
    if(isset($_POST['email'], $_POST['password'], $_POST['type'])){
        require_once("../core/authentificate.php");
        switch(authentificate($_POST['email'], $_POST['password'], $_POST['type'])){
            case 1:
                unset($error);
                header("location: /home");
                break;
            case 2:
                $error = 'Aucun compte associé à ce login.';
                break;
            case 3:
                $error = 'Votre mot de passe est incorrect.';
                break;
        }
    }
?>


<?php if(isset($error)) echo '<div class="messagebox error"> '. $error .'</div>'; ?>

<form action="login" method="post">
    <fieldset>
        <legend>Login</legend>
        <span>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="ex : jean@gmail.com">
        </span>
        <span>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </span>
        <span>
            <label for="type">Type</label>
            <span id="type" style="display:inline;">
                <input type="radio" name="type" id="salarie" value="0">
                <label for="salarie">Salarié</label>
                <input type="radio" name="type" id="admin" value="1">
                <label for="admin">Administrateur</label>
            </span>     
        </span>
    </fieldset>
    <span>
        <input type="submit" value="S'authentifier">
    </span>
</form>
