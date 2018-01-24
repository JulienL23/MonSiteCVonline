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
if (isset($_POST['f_titre'])) { // par le nom du premier input
    $f_titre = addslashes($_POST['f_titre']);
    $f_soustitre = addslashes($_POST['f_soustitre']);
    $f_description = addslashes($_POST['f_description']);
    $f_dates = addslashes($_POST['f_dates']);
    $id_formation = addslashes($_POST['id_formation']);

    $pdoCV->exec(" UPDATE t_formations SET f_titre='$f_titre', f_soustitre='$f_soustitre', f_description='$f_description', f_dates='$f_dates' WHERE id_formation='$id_formation'");
    header('location: formations.php');
    exit();
}

// je récupère la compétence
$id_formation = $_GET['id_formation']; //par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_formations WHERE id_formation='$id_formation'"); // la requete est égale à l'id
$ligne_formation = $sql->fetch();
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
            <li><h2>Modification de <?php echo ($ligne_formation['f_titre']); ?></h2></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Formation</h3>
                    <form  action="modif_formation.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="f_titre">Titre</label>
                                <input class="form-control" type="text" name="f_titre" id="f_titre" value="<?php echo $ligne_formation['f_titre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="f_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="f_soustitre" id="f_soustitre" value="<?php echo $ligne_formation['f_soustitre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="f_description">Description</label>
                                <textarea class="form-control" id="editor1" name="f_description"><?php echo $ligne_formation['f_description']; ?></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label for="f_dates">Date</label>
                                <input class="form-control" type="text" name="f_dates" id="f_dates" value="<?php echo $ligne_formation['f_dates']; ?>">
                            </div>
                            <input hidden name="id_formation" value="<?php echo $ligne_formation['id_formation']; ?>">
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
