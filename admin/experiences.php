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
if (isset($_POST['e_titre']) && ($_POST['e_soustitre']) && ($_POST['e_description']) && ($_POST['e_dates'])) { // si on a posté une nouvelle comp.
    if ($_POST['e_titre'] != '' && $_POST['e_soustitre'] != '' && $_POST['e_description'] != '' && $_POST['e_dates'] != '') {// si compétence n'est pas vide // (!empty ($_POST['experience'])) aurais marché aussi
        $e_titre = addslashes($_POST['e_titre']);
        $e_soustitre = addslashes($_POST['e_soustitre']);
        $e_description = addslashes($_POST['e_description']);
        $e_dates = addslashes($_POST['e_dates']);
        $pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$e_titre', '$e_soustitre', '$e_dates', '$e_description', '1')"); // mettre $id_utilisateur quand on l'aura dans la variable se session
        header("location:experiences.php"); // pour revenir sur la page
        exit();
    } // ferme le if n'est pas vide
} // ferme le if n'est pas vide
// suppression d'une compétence
if (isset($_GET['id_experience'])) { // on récupère la comp. par son id dans l'url
    $efface = $_GET['id_experience']; // je mets dela dans une variable

    $sql = " DELETE FROM t_experiences WHERE id_experience = '$efface'";
    $pdoCV->query($sql); // on peut avec exec aussi si on veut
    header("location:experiences.php"); // pour revenir sur la page
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
    $sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE utilisateur_id ='1' ");
    $sql->execute();
    $nbr_experiences = $sql->rowCount();
// $ligne_experience = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2>Il y a <?php echo $nbr_experiences; ?> expériences </h2>
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
                                <?php while ($ligne_experience = $sql->fetch()) { ?>
                                    <th><?php echo $ligne_experience['e_titre']; ?></th>
                                    <td><?php echo $ligne_experience['e_soustitre']; ?></td>
                                    <td><?php echo $ligne_experience['e_description']; ?></td>
                                    <td><?php echo $ligne_experience['e_dates']; ?></td>
                                    <td class="supp"><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                    <td class="modi"><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
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
                    <h3>Insertion d'une expérience</h3>
                    <form  action="experiences.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="e_titre">Titre</label>
                                <input class="form-control" type="text" name="e_titre" id="e_titre" placeholder="Insèrer un titre">
                            </div>
                            <div class="form-group">
                                <label for="e_soustitre">Sous-titre</label>
                                <input class="form-control" type="text" name="e_soustitre" id="e_soustitre" placeholder="Insèrer un sous-titre">
                            </div>
                            <div class="form-group">
                                <label for="e_description">Description</label>
                                <textarea class="form-control" id="editor1" name="e_description" placeholder="Décrire la formation"></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label for="e_dates">Date</label>
                                <input class="form-control" type="text" name="e_dates" id="e_dates" placeholder="Insèrer la description">
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
