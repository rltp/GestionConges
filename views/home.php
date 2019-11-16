</article>
<div class="hero-image">
    <div class="text">
        <h1 style="font-size:50px"><?= (isAllowedToDisplay(0)) ? "Bienvenue <u>".$_SESSION["name"]."</u>" : "ESME Sudria"?></h1>
        <label><?= (isAllowedToDisplay(0)) ? ($_SESSION['function'] == "P") ? "Personnel administratif" : "Enseignant" : "Ingénieur de tout les possibles"?></label>
    </div>
</div>
<article>
<p class="text-present">
    Fondée en 1905, l’école d'ingénieurs ESME Sudria forme en 5 ans des ingénieurs pluridisciplinaires, prêts à relever les défis technologiques du XXIe siècle : la transition énergétique, les véhicules autonomes, la robotique, les réseaux intelligents, les villes connectées, la cyber sécurité, et les biotechnologies.
    <br>
    Trois composantes font la modernité de sa pédagogie : l’importance de l’esprit d’innovation; l’omniprésence du projet et de l’initiative; une très large ouverture internationale, humaine et culturelle. Depuis sa création, plus de 15 000 ingénieurs ont été diplômés. L'école délivre un diplôme reconnu par l'Etat et accrédité par la CTI.
</p>
<?php if(isAllowedToDisplay(0)) {?>
    <a class="btn" href="/logout">Logout</a>
<?php }else{?>
    <a class="btn" href="/login">Login</a>
<?php } ?>