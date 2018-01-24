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
if (isset($_POST['e_titre'])) { // par le nom du premier input
    $e_titre = addslashes($_POST['e_titre']);
    $e_soustitre = addslashes($_POST['e_soustitre']);
    $e_description = addslashes($_POST['e_description']);
    $e_dates = addslashes($_POST['e_dates']);
    $id_experience = addslashes($_POST['id_experience']);

    $pdoCV->exec(" UPDATE t_experiences SET e_titre='$e_titre', e_soustitre='$e_soustitre', e_description='$e_description', e_dates='$e_dates' WHERE id_experience='$id_experience'");
    header('location: experiences.php');
    exit();
}

// je récupère la compétence
$id_experience = $_GET['id_experience']; //par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience'"); // la requete est égale à l'id
$ligne_experience = $sql->fetch();
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
            <li><h2>Modification de <?php echo ($ligne_experience['e_titre']); ?></h2></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Expérience</h3>
                    <form  action="modif_experience.php" method="post">
                        <fieldset>
                            <input hidden name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                            <div class="form-group">
                                <label for="e_titre">Titre</label>
                                <input class="form-control" type="text" name="e_titre" id="e_titre" value="<?php echo $ligne_experience['e_titre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="e_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="e_soustitre" id="e_soustitre" value="<?php echo $ligne_experience['e_soustitre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="e_description">Description</label>
                                <textarea class="form-control" id="editor1" name="e_description"><?php echo $ligne_experience['e_description']; ?></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label for="e_dates">Date</label>
                                <input class="form-control" type="text" name="e_dates" id="e_dates" value="<?php echo $ligne_experience['e_dates']; ?>">
                            </div>
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
