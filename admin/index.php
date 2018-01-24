<?php require 'connexion.php'; ?>
<?php
session_start();
// Redirige si non connecté
if (isset($_SESSION['connexion']) && $_SESSION['connexion'] == 'connecté') {
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];

    // echo $_SESSION['connexion'];
} else { // l'utilisateur n'est pas connecté
    header('location: loggin.php');
}
//fin de la reddirection
?>
<?php require 'inc/nav.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ol class="breadcrumb text-center">
                <li><h1>Admin : Site cv <?= ($ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']); ?></h1></li>
                <hr>
            </ol>
        </div>
    </div>
    <hr>
</div>


<?php require 'inc/footer.php'; ?>
