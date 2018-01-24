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
if (isset($_POST['competence'])) { // si on a posté une nouvelle comp.
    if ($_POST['competence'] != '' && $_POST['c_niveau'] != '') {// si compétence n'est pas vide // (!empty ($_POST['competence'])) aurais marché aussi
        $competence = addslashes($_POST['competence']);
        $c_niveau = addslashes($_POST['c_niveau']);
        $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$c_niveau', '1')"); // mettre $id_utilisateur quand on l'aura dans la variable se session
        header("location:competences.php"); // pour revenir sur la page
        exit();
    } // ferme le if n'est pas vide
} // ferme le if n'est pas vide
// suppression d'une compétence
if (isset($_GET['id_competence'])) { // on récupère la comp. par son id dans l'url
    $efface = $_GET['id_competence']; // je mets dela dans une variable

    $sql = " DELETE FROM t_competences WHERE id_competence = '$efface'";
    $pdoCV->query($sql); // on peut avec exec aussi si on veut
    header("location:competences.php"); // pour revenir sur la page
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
    $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE utilisateur_id ='1' ");
    $sql->execute();
    $nbr_competences = $sql->rowCount();
// $ligne_competence = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2>Il y a <?php echo $nbr_competences; ?> compétences </h2>
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
                                <th>Compétences</th>
                                <th>Niveau en %</th>
                                <th>Suppression</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($ligne_competence = $sql->fetch()) { ?>
                                    <th><?php echo $ligne_competence['competence']; ?></th>
                                    <td><?php echo $ligne_competence['c_niveau']; ?></td>
                                    <td class="supp"><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                    <td class="modi"><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
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
                    <h3>Insertion d'une compétence</h3>
                    <form  action="competences.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="competence">Compétence</label>
                                <input class="form-control" type="text" name="competence" id="competence" placeholder="Insèrer une compétence">
                            </div>
                            <div class="form-group">
                                <label for="c_niveau">Niveau</label>
                                <input class="form-control" type="text" name="c_niveau" id="c_niveau" placeholder="Insèrer le niveau">
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
