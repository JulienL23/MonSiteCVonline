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
// gestion des contenus de la BDD
//insertion d'une compétence
if (isset($_POST['r_titre']) && ($_POST['r_soustitre']) && ($_POST['r_description']) && ($_POST['r_dates'])) { // si on a posté une nouvelle comp.
    if ($_POST['r_titre'] != '' && $_POST['r_soustitre'] != '' && $_POST['r_description'] != '' && $_POST['r_dates'] != '') {// si compétence n'est pas vide // (!empty ($_POST['realisation'])) aurais marché aussi
        $r_titre = addslashes($_POST['r_titre']);
        $r_soustitre = addslashes($_POST['r_soustitre']);
        $r_description = addslashes($_POST['r_description']);
        $r_dates = addslashes($_POST['r_dates']);
        $r_photo = addslashes($_POST['r_photo']);
        $pdoCV->exec(" INSERT INTO t_realisations VALUES (NULL, '$r_titre', '$r_soustitre', '$r_dates', '$r_description', '$r_photo', '1')"); // mettre $id_utilisateur quand on l'aura dans la variable se session
        header("location:realisations.php"); // pour revenir sur la page
        exit();
    } // ferme le if n'est pas vide
} // ferme le if n'est pas vide
// suppression d'une compétence
if (isset($_GET['id_realisation'])) { // on récupère la comp. par son id dans l'url
    $efface = $_GET['id_realisation']; // je mets dela dans une variable

    $sql = " DELETE FROM t_realisations WHERE id_realisation = '$efface'";
    $pdoCV->query($sql); // on peut avec exec aussi si on veut
    header("location:realisations.php"); // pour revenir sur la page
}// ferme le if isset
?>
<?php require 'inc/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ol class="breadcrumb text-center">
                <li><h1>Admin : Site cv <?= ($ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']); ?></h1></li>
            </ol>
        </div>
    </div>
    <?php
    $sql = $pdoCV->prepare(" SELECT * FROM t_realisations WHERE utilisateur_id ='1' ");
    $sql->execute();
    $nbr_realisations = $sql->rowCount();
// $ligne_realisation = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2>Il y a <?php echo $nbr_realisations; ?> réalisations </h2>
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
                                <th>Titre</th>
                                <th>Sous-titre</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Dates</th>
                                <th>Suppression</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($ligne_realisation = $sql->fetch()) { ?>
                                    <th><?php echo $ligne_realisation['r_titre']; ?></th>
                                    <td><?php echo $ligne_realisation['r_soustitre']; ?></td>
                                    <td><?php echo $ligne_realisation['r_description']; ?></td>
                                    <td><?php echo $ligne_realisation['r_photo']; ?></td>
                                    <td><?php echo $ligne_realisation['r_dates']; ?></td>
                                    <td class="supp"><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                    <td class="modi"><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
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
                    <h3>Insertion d'une réalisation</h3>
                    <form  action="realisations.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="r_titre">Titre</label>
                                <input class="form-control" type="text" name="r_titre" id="r_titre" placeholder="Insèrer un titre">
                            </div>
                            <div class="form-group">
                                <label for="r_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="r_soustitre" id="r_soustitre" placeholder="Insèrer un sous-titre">
                            </div>
                            <div class="form-group">
                                <label for="r_description">Description</label>
                                <textarea class="form-control" id="editor1" name="r_description"></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label for="r_photo">Photo</label>
                                <input class="form-control" type="text" name="r_photo" id="r_photo" placeholder="Insèrer une photo">
                            </div>
                            <div class="form-group">
                                <label for="r_dates">Date</label>
                                <input class="form-control" type="text" name="r_dates" id="r_dates" placeholder="Insèrer la description">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Insérez">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->


<?php require 'inc/footer.php'; ?>
