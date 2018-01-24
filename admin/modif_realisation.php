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
if (isset($_POST['r_titre'])) { // par le nom du premier input
    $r_titre = addslashes($_POST['r_titre']);
    $r_soustitre = addslashes($_POST['r_soustitre']);
    $r_description = addslashes($_POST['r_description']);
    $r_photo = addslashes($_POST['r_photo']);
    $r_dates = addslashes($_POST['r_dates']);
    $id_realisation = addslashes($_POST['id_realisation']);

    $pdoCV->exec(" UPDATE t_realisations SET r_titre='$r_titre', r_soustitre='$r_soustitre', r_description='$r_description', r_photo='$r_photo', r_dates='$r_dates' WHERE id_realisation='$id_realisation'");
    header('location: realisations.php');
    exit();
}

// je récupère la compétence
$id_realisation = $_GET['id_realisation']; //par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_realisations WHERE id_realisation='$id_realisation'"); // la requete est égale à l'id
$ligne_realisation = $sql->fetch();
?>

<?php require 'inc/nav.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <ol class="breadcrumb text-center">
            <li><h1>Admin : Site cv <?= ($ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']); ?></h1></li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <ol class="breadcrumb text-center">
            <li><h2>Modification de <?php echo ($ligne_realisation['r_titre']); ?></h2></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Réalisation</h3>
                    <form  action="modif_realisation.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="r_titre">Titre</label>
                                <input class="form-control" type="text" name="r_titre" id="r_titre" value="<?php echo $ligne_realisation['r_titre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="r_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="r_soustitre" id="r_soustitre" value="<?php echo $ligne_realisation['r_soustitre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="r_dates">Date</label>
                                <input class="form-control" type="text" name="r_dates" id="r_dates" value="<?php echo $ligne_realisation['r_dates']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="r_photo">Photo</label>
                                <input class="form-control" type="text" name="r_photo" id="r_dphoto" value="<?php echo $ligne_realisation['r_photo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="r_description">Description</label>
                                <textarea class="form-control" id="editor1" name="r_description"><?php echo $ligne_realisation['r_description']; ?></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <input hidden name="id_realisation" value="<?php echo $ligne_realisation['id_realisation']; ?>">
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
