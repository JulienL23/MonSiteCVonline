<?php require 'connexion.php'; ?>
<?php
session_start();
$msg_auth_err = '';
//
if (isset($_GET['quit']) && $_GET['quit'] == 'oui') {// on récupère le terme quitter dans l'url
    $_SESSION['connexion'] = ''; // on vide les variables de session
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['prenom'] = '';
    $_SESSION['nom'] = '';

    unset($_SESSION['connexion']);
    session_destroy();
    header('location:../index.php');
}
if (isset($_POST['connexion'])) { // on envoie le form avec le name du button (on a cliqué dessus)
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);
    $sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp'"); // on vérifie courriel et mdp
    $sql->execute();
    $nbr_utilisateur = $sql->rowCount(); // On compte s'il est dans la table, le compte répond 1 s'il y est, 0 s'il n'y est pas
    if ($nbr_utilisateur == 0) {// il n'y est pas !
        $msg_auth_err = "Erreur d'authentification";
    } else {//on le trouve, il est inscrit
        $ligne_utilisateur = $sql->fetch(); //on cherche les infos

        $_SESSION['connexion'] = 'connecté';
        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['prenom'] = $ligne_utilisateur['prenom'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];

        header('location: index.php');
    }// ferme le if else
}// ferme le if isset
?>

<?php require 'inc/head.php'; ?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Authentification : Admin</title>
    </head>
    <body>
        <H1>Admin : s'authentifier</H1>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="loggin.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label for="email">Courriel</label>
                                <input type="email" name="email" placeholder="Votre courriel" class="form-control" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required>
                            </div>
                            <br>
                            <button name="connexion" type="submit" class="btn btn-primary">Connexion à votre admin.</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
