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
//suppression d'un message

if (isset($_GET['id_commentaire'])) {// récupère l'id_competence dans l'url
    $efface = $_GET['id_commentaire']; // je met cela dans une variable
    $sql = "DELETE FROM t_commentaires WHERE id_commentaire = '$efface' ";
    $pdoCV->query($sql); //on peut aussi faire un exec.
    header("location:messagerie.php");
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
    $sql = $pdoCV->prepare("SELECT * FROM t_commentaires");
    $sql->execute();
    $nbr_commentaires = $sql->rowCount();
//$ligne_competences = $sql -> fetch();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="breadcrumb text-center">
                <h2> Il y a <?php echo $nbr_commentaires; ?> messages.</h2>
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
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Message</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($ligne_commentaire = $sql->fetch()) { ?>
                                    <th scope="row"><?php echo $ligne_commentaire['co_nom']; ?></th>
                                    <th scope="row"><?php echo $ligne_commentaire['co_email']; ?></th>
                                    <th scope="row"><?php echo $ligne_commentaire['co_sujet']; ?></th>
                                    <th scope="row"><?php echo $ligne_commentaire['co_message']; ?></th>
                                    <td class="supp"><a href="messagerie.php?id_commentaire=<?php echo $ligne_commentaire['id_commentaire']; ?>"><span class="glyphicon glyphicon-trash" style="font-size:23px;"></span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'inc/footer.php'; ?>