<?php
    session_start();
    $page_name = "historique";
?>
<?php ob_start(); ?>
    <h2>historiqueez-nous</h2>
    <?php if(!empty($_SESSION['error'])): ?>
        <div class="Error">
            <p><?= $_SESSION['error']; ?></p>
        </div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['successMsg'])): ?>
        <div class="successMsg">
            <p><?= $_SESSION['successMsg']; ?></p>
        </div>
    <?php endif; ?>
    <form class="historiqueForm" action="backend/historique_back.php" method="POST">
        <div class="historiqueForm__Line">
            <input type="text" name="firstname" placeholder="Prénom" required />
            <input type="text" name="lastname" placeholder="Nom" required />
        </div>
        <input class="email" type="email" name="email" placeholder="email" required>
        <textarea name="message" id="" cols="30" rows="10" placeholder="Que puis-je faire pour vous ?" required ></textarea>
        <button type="submit">Envoyer</button>
    </form>
<?php
if(isset($_SESSION['error'])){
    unset($_SESSION['error']);
}
if(isset($_SESSION['successMsg'])){
    unset($_SESSION['successMsg']);
}
$content = ob_get_clean();
include("layouts/base_layout.php"); 