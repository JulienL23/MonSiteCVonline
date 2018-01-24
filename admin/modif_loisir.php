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
if (isset($_POST['loisir'])) { // par le nom du premier input
    $loisirs = addslashes($_POST['loisir']);
    $accroche = addslashes($_POST['accroche']);
    $photo = addslashes($_POST['photo']);
    $id_loisir = addslashes($_POST['id_loisir']);

    $pdoCV->exec(" UPDATE t_loisirs SET loisir='$loisirs', accroche='$accroche', photo='$photo' WHERE id_loisir='$id_loisir'");
    header('location: loisirs.php');
    exit();
}
// je récupère la compétence
$id_loisir = $_GET['id_loisir']; //par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'"); // la requete est égale à l'id
$ligne_loisir = $sql->fetch();
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
            <li><h2>Modification de <?php echo ($ligne_loisir['loisir']); ?></h2></li>
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
                    <form action="modif_loisir.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="loisir">Loisir</label>
                                <input class="form-control" type="text" name="loisir" id="loisir" value="<?php echo $ligne_loisir['loisir']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="accroche">Accroche</label>
                                <input class="form-control" type="text" name="accroche" id="accroche" value="<?php echo $ligne_loisir['accroche']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input class="form-control" type="text" name="photo" id="photo" value="<?php echo $ligne_loisir['photo']; ?>">
                            </div>
                            <input hidden name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                            <input class="btn btn-primary" type="submit" value="Mettre à jour">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>
