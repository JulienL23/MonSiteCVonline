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
if (isset($_POST['f_titre']) && ($_POST['f_soustitre']) && ($_POST['f_description']) && ($_POST['f_dates'])) { // si on a posté une nouvelle comp.
    if ($_POST['f_titre'] != '' && $_POST['f_soustitre'] != '' && $_POST['f_description'] != '' && $_POST['f_dates'] != '') {// si compétence n'est pas vide // (!empty ($_POST['formation'])) aurais marché aussi
        $f_titre = addslashes($_POST['f_titre']);
        $f_soustitre = addslashes($_POST['f_soustitre']);
        $f_description = addslashes($_POST['f_description']);
        $f_dates = addslashes($_POST['f_dates']);
        $pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$f_titre', '$f_soustitre', '$f_dates', '$f_description', '1')"); // mettre $id_utilisateur quand on l'aura dans la variable se session
        header("location:formations.php"); // pour revenir sur la page
        exit();
    } // ferme le if n'est pas vide
} // ferme le if n'est pas vide
// suppression d'une compétence
if (isset($_GET['id_formation'])) { // on récupère la comp. par son id dans l'url
    $efface = $_GET['id_formation']; // je mets dela dans une variable

    $sql = " DELETE FROM t_formations WHERE id_formation = '$efface'";
    $pdoCV->query($sql); // on peut avec exec aussi si on veut
    header("location:formations.php"); // pour revenir sur la page
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
    $sql = $pdoCV->prepare(" SELECT * FROM t_formations WHERE utilisateur_id ='1' ");
    $sql->execute();
    $nbr_formations = $sql->rowCount();
// $ligne_formation = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2>Il y a <?php echo $nbr_formations; ?> formations </h2>
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
                                <th>Date</th>
                                <th>Suppression</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($ligne_formation = $sql->fetch()) { ?>
                                    <th><?php echo $ligne_formation['f_titre']; ?></th>
                                    <td><?php echo $ligne_formation['f_soustitre']; ?></td>
                                    <td><?php echo $ligne_formation['f_description']; ?></td>
                                    <td><?php echo $ligne_formation['f_dates']; ?></td>
                                    <td class="supp"><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                    <td class="modi"><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
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
                    <h3>Insertion d'une formation</h3>
                    <form  action="formations.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="f_titre">Titre</label>
                                <input class="form-control" type="text" name="f_titre" id="f_titre" placeholder="Insèrer un titre">
                            </div>
                            <div class="form-group">
                                <label for="f_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="f_soustitre" id="f_soustitre" placeholder="Insèrer un sous-titre">
                            </div>
                            <div class="form-group">
                                <label for="f_description">Description</label>
                                <textarea class="form-control" id="editor1" name="f_description"></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label for="f_dates">Date</label>
                                <input class="form-control" type="text" name="f_dates" id="f_dates" placeholder="Insèrer la description">
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
