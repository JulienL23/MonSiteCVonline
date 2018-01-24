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
//
// mise à jour des compétences
if (isset($_POST['competence'])) { // par le nom du premier input
    $competence = addslashes($_POST['competence']);
    $c_niveau = addslashes($_POST['c_niveau']);
    $id_competence = addslashes($_POST['id_competence']);

    $pdoCV->exec(" UPDATE t_competences SET competence='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence'");
    header('location: competences.php');
    exit();
}
// je récupère la compétence
$id_competence = $_GET['id_competence']; //par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence='$id_competence'"); // la requete est égale à l'id
$ligne_competence = $sql->fetch();
?>

<?php require 'inc/nav.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <ol class="breadcrumb text-center">
            <li><h1>Admin : Site cv <?= ($ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']); ?></h1></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <ol class="breadcrumb text-center">
            <li><h2>Modification de <?php echo ($ligne_competence['competence']); ?></h2></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Loisirs</h3>
                    <form action="modif_competence.php" method="post">
                        <div class="form-group">
                            <label for="competence">Compétence</label>
                            <input class="form-control" type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="c_niveau">Compétence</label>
                            <input class="form-control" type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau']; ?>">
                        </div>
                        <input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                        <input class="btn btn-primary" type="submit" value="Mettre à jour">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>
