<?php
require 'connexion.php';
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
//gestion des contenu de la BDD competence
//insertion d'une compétence

if (isset($_POST['loisir']) && ($_POST['accroche']) && ($_POST['photo'])) {//si on a posté une nouvelle compétence
    if ($_POST['loisir'] != '' && $_POST['accroche'] != '' && $_POST['photo'] != '') {// si compétence n'est pas vide
        $loisirs = addslashes($_POST['loisir']);
        $accroches = addslashes($_POST['accroche']);
        $photos = addslashes($_POST['photo']);
        //$c_niveau =  addslashes($_POST['c_niveau']);
        $pdoCV->exec("INSERT INTO t_loisirs VALUES (NULL, '$loisirs','$accroches','$photos', '1')"); //mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location:loisirs.php");
        exit();
    }//fin if($_post['competence'] != '' && $_POST['c_niveau'] !='')
}//if(isset($_POST['competence']))
//suppression d'une competence

if (isset($_GET['id_loisir'])) {// récupère l'id_competence dans l'url
    $efface = $_GET['id_loisir']; // je met cela dans une variable
    $sql = "DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
    $pdoCV->query($sql); //on peut aussi faire un exec.
    header("location:loisirs.php");
} // fin du if(isset())
?>
<?php require 'inc/nav.php'; ?>
<!-- Traitement HTML -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ol class="breadcrumb text-center">
                <li><h1>Admin : Site cv <?= ($ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']); ?></h1></li>
            </ol>
        </div>
    </div>

    <?php
    $sql = $pdoCV->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id = '1'");
    $sql->execute();
    $nbr_loisirs = $sql->rowCount();
//$ligne_competences = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2> Il y a <?php echo $nbr_loisirs; ?> Loisirs</h2>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Loisirs</th>
                                <th>Accroche</th>
                                <th>Photo</th>
                                <th>Supprimer</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($ligne_loisir = $sql->fetch()) { ?>
                                    <th scope="row"><?php echo $ligne_loisir['loisir']; ?></th>
                                    <th scope="row"><?php echo $ligne_loisir['accroche']; ?></th>
                                    <th scope="row"><?php echo $ligne_loisir['photo']; ?></th>
                                    <td class="supp"><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                    <td class="modi"><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Insertion d'un loisir</h3>
                    <form class="loisirs.php" action="#" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="loisir">Loisirs</label>
                                <input class="form-control" type="text" name="loisir" id="loisir" placeholder="Insérer un loisir">
                            </div>
                            <div class="form-group">
                                <label for="accroche">Accroche</label>
                                <input class="form-control" type="text" name="accroche" id="accroche" placeholder="Insérer une accroche">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input class="form-control" type="text" name="photo" id="photo" placeholder="Insérer une photo">
                            </div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Insérez">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<?php require 'inc/footer.php'; ?>
