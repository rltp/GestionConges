<header>
    <div class="nav">
        <span class="logo"><a href="/"><img src="/media/img/logo.png" height="70"/></a></span>
        <span class="title"><h1>Gestion des congés</h1></span>
        <span class="option">
        <?php if(!empty($_SESSION)) { ?>
        <div class="dropdown">
            <a class="dropdown-toggle">
                <img src="/media/upload/Pics/<?= $_SESSION['id'] ?>" width="40" height="40"\>
            </a>
            <div class="dropdown-content">
                <label>Connecté en tant que <strong><?= $_SESSION['name']?></strong></label >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"  <?= ($view == "") ? "active": "" ?> href="/">Accueil</a>
                <?php if(isAllowedToDisplay(0)) {?><a class="dropdown-item" <?= ($view == "gestionConges") ? "active": "" ?> href="/gestionConges">Gestion des congés</a><?php } ?>
                <?php if(isAllowedToDisplay(0)) {?><a class="dropdown-item" <?= ($view == "gestionMessages") ? "active": "" ?> href="/gestionMessages">Gestion des messages</a><?php } ?>
                <?php if(isAllowedToDisplay(1)) {?><a class="dropdown-item" <?= ($view == "gestionSalaries") ? "active": "" ?> href="/gestionSalaries">Gestion des salariés</a><?php } ?>
                <?php if(isAllowedToDisplay(0)) {?><a class="dropdown-item" <?= ($view == "gestionProfil") ? "active": "" ?> href="/gestionProfil">Gestion profil</a><?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"><strong>Déconnection</strong></a>
            </div>
        </div>
        <?php }else{ ?> 
            <a href="/login">Login</a>
        <?php } ?>
        </span>
    </div>
</header