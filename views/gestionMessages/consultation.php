<?php if(!empty($_POST) && !empty($errors)) {?>
    <div class="messagebox error"><u>Erreur :</u><ul><?php foreach($errors as $e) echo "<li>".$e."</li>"; ?></ul></div>
<?php } ?>

<div class="comments">
    <div class="talks">
        <h3>Discussions</h3>
        <div class="talk_divider"></div>
        <?php
            if(!empty($talks)){
                foreach($talks as $comment){
                    $salaried = getInfos($comment['fromID']);
        ?>
        <a class="talk<?= ((empty($parameter)? $talks[0]['fromID'] : $parameter) == $comment['fromID'])? " active" : "" ?>" href="/gestionMessages/consultation/<?= $comment['fromID'] ?>">
            <img class="pic" src="/media/upload/Pics/<?= $comment['fromID'] ?>" width="50" height="50"\>
            <span class="talk_content">
                <h3><?= $salaried['firstname']." ".$salaried['lastname'] ?></h3>
            </span>
            <?php if(($pop = countUnseenComment($_SESSION['id'], $comment['fromID']))) echo "<pop>".$pop."</pop>"; ?>
        </a>
    <?php } }else{ ?>
        <label>Aucun message pour le moment<label>
    <?php } ?>
    </div>
    <div class="feeds">
        <?php
            if(!empty($talks)) $comments = getComments(($user = (empty($parameter))? $talks[0]['fromID'] : $parameter), $_SESSION['id']);
            if(!empty($comments)){ 
        ?>
            <div class="feeds-inner">
            <?php
                    foreach($comments as $comment){
                        $salaried = getInfos($comment['fromID']);
            ?>
                <content class="comment">
                    <img class="pic" src="/media/upload/Pics/<?= $comment['fromID'] ?>" width="50" height="50"\>
                    <span class="comment_content">
                        <span class="title">
                            <h3><?= $salaried['firstname']." ".$salaried['lastname'] ?></h3>
                            <label><?= $comment['date'] ?></label>
                        </span>
                        <text><?= $comment['comment'] ?></text>
                    </span>
                    <?php if($_SESSION['level']) { ?>
                    <span class="remove">
                        <form action="" method="post">
                            <input type="hidden" name="remove" value="<?= $comment['id'] ?>"/>
                            <button notinherit ><img src="/media/img/x.svg"></button>
                        </form>
                    </span>
                    <?php } ?>
                </content>
            <?php } ?>
            </div>
            <form action="" method="post">
                <div class="message">
                    <input type="hidden" name="toID" value="<?= (empty($parameter))? $talks[0]['fromID'] : $parameter ?>"/>
                    <textarea notinherit name="message"></textarea>
                    <button notinherit ><img src="/media/img/arrow-circle-right.svg"></button>
                </div>
            </form>
        <?php }else{ ?>
            <img src="/media/img/emptybox.png" width="500"/>
        <?php } ?>
    </div>
</div>
<script>
    let el = document.querySelector(".feeds-inner");
    el.scrollTop = el.scrollHeight;
</script>
