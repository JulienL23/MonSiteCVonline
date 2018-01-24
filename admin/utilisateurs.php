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
if (isset($_POST['prenom'])) { // si on a posté une nouvelle comp.
    if ($_POST['prenom'] != '' && $_POST['nom'] != '' && $_POST['email'] != '' && $_POST['telephone'] != '' && $_POST['mdp'] != '' && $_POST['pseudo'] != '' && $_POST['avatar'] != '' && $_POST['age'] != '' && $_POST['date_naissance'] != '' && $_POST['sexe'] != '' && $_POST['etat_civil'] != '' && $_POST['adresse'] != '' && $_POST['code_postal'] != '' && $_POST['ville'] != '' && $_POST['pays'] != '' && $_POST['site_web'] != '') {

        $prenom = addslashes($_POST['prenom']);
        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $telephone = addslashes($_POST['telephone']);
        $mdp = addslashes($_POST['mdp']);
        $pseudo = addslashes($_POST['pseudo']);
        $avatar = addslashes($_POST['avatar']);
        $age = addslashes($_POST['age']);
        $date_naissance = addslashes($_POST['date_naissance']);
        $sexe = addslashes($_POST['sexe']);
        $etat_civil = addslashes($_POST['etat_civil']);
        $adresse = addslashes($_POST['adresse']);
        $code_postal = addslashes($_POST['code_postal']);
        $ville = addslashes($_POST['ville']);
        $pays = addslashes($_POST['pays']);
        $site_web = addslashes($_POST['site_web']);
        $pdoCV->exec(" INSERT INTO t_utilisateurs VALUES (NULL, '$prenom', '$nom', '$email', '$telephone', '$mdp', '$pseudo', '$avatar', '$age', '$date_naissance', '$sexe', '$etat_civil', '$adresse', '$code_postal', '$ville', '$pays', '$site_web' '1')"); // mettre $id_utilisateur quand on l'aura dans la variable se session
        header("location:utilisateurs.php"); // pour revenir sur la page
        exit();
    } // ferme le if n'est pas vide
} // ferme le if n'est pas vide
// suppression d'une compétence
if (isset($_GET['id_utilisateur'])) { // on récupère la comp. par son id dans l'url
    $efface = $_GET['id_utilisateur']; // je mets dela dans une variable

    $sql = " DELETE FROM t_utilisateurs WHERE id_utilisateur = '$efface'";
    $pdoCV->query($sql); // on peut avec exec aussi si on veut
    header("location:utilisateurs.php"); // pour revenir sur la page
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

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Mot de passe</th>
                                <th>Pseudo</th>
                                <th>Avatar</th>
                                <th>Age</th>
                                <th>Date de Naissance</th>
                                <th>Sexe</th>
                                <th>Etat Civil</th>
                                <th>Adresse</th>
                                <th>Code Postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>Site Web</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo $ligne_utilisateur['prenom']; ?></th>
                                <td><?php echo $ligne_utilisateur['nom']; ?></td>
                                <td><?php echo $ligne_utilisateur['email']; ?></td>
                                <td><?php echo $ligne_utilisateur['telephone']; ?></td>
                                <td><?php echo $ligne_utilisateur['mdp']; ?></td>
                                <td><?php echo $ligne_utilisateur['pseudo']; ?></td>
                                <td><?php echo $ligne_utilisateur['avatar']; ?></td>
                                <td><?php echo $ligne_utilisateur['age']; ?></td>
                                <td><?php echo $ligne_utilisateur['date_naissance']; ?></td>
                                <td><?php echo $ligne_utilisateur['sexe']; ?></td>
                                <td><?php echo $ligne_utilisateur['etat_civil']; ?></td>
                                <td><?php echo $ligne_utilisateur['adresse']; ?></td>
                                <td><?php echo $ligne_utilisateur['code_postal']; ?></td>
                                <td><?php echo $ligne_utilisateur['ville']; ?></td>
                                <td><?php echo $ligne_utilisateur['pays']; ?></td>
                                <td><?php echo $ligne_utilisateur['site_web']; ?></td>
                                <td class="modi"><a href="modif_utilisateur.php?id_utilisateur=<?php echo $ligne_utilisateur['id_utilisateur']; ?>"><span class="glyphicon glyphicon-cog" style="font-size:23px;"></span></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Insertion d'un utilisateur</h3>
                        <form  action="utilisateurs.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="prenom">Prenom</label>
                                    <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Insèrer un prenom">
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input class="form-control" type="text" name="nom" id="nom" placeholder="Insèrer un nom">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Insèrer un email">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input class="form-control" type="text" name="telephone" id="telephone" placeholder="Insèrer un telephone">
                                </div>
                                <div class="form-group">
                                    <label for="mdp">Mot de Passe</label>
                                    <input class="form-control" type="text" name="mdp" id="mdp" placeholder="Insèrer le mot de passe">
                                </div>
                                <div class="form-group">
                                    <label for="pseudo">Pseudo</label>
                                    <input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="Insèrer le pseudo">
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input class="form-control" type="text" name="avatar" id="avatar" placeholder="Insèrer un avatar">
                                </div>
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input class="form-control" type="text" name="age" id="age" placeholder="Insèrer un age">
                                </div>
                                <div class="form-group">
                                    <label for="date_naissance">Date de Naissance</label>
                                    <input class="form-control" type="text" name="date_naissance" id="date_naissance" placeholder="Insèrer la date de naissance">
                                </div>
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <input class="form-control" type="text" name="sexe" id="sexe" placeholder="Insèrer le sexe">
                                </div>
                                <div class="form-group">
                                    <label for="etat_civil">Etat civil</label>
                                    <input class="form-control" type="text" name="etat_civil" id="etat_civil" placeholder="Insèrer l'etat civil">
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input class="form-control" type="text" name="adresse" id="adresse" placeholder="Insèrer l'adresse">
                                </div>
                                <div class="form-group">
                                    <label for="code_postal">Code Postal</label>
                                    <input class="form-control" type="text" name="code_postal" id="code_postal" placeholder="Insèrer le code postal">
                                </div>
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <input class="form-control" type="text" name="ville" id="ville" placeholder="Insèrer la ville">
                                </div>
                                <div class="form-group">
                                    <label for="pays">Pays</label>
                                    <input class="form-control" type="text" name="pays" id="pays" placeholder="Insèrer le pays">
                                </div>
                                <div class="form-group">
                                    <label for="site_web">Site Web</label>
                                    <input class="form-control" type="text" name="site_web" id="site_web" placeholder="Insèrer le site web">
                                </div>
                                <input class="btn btn-primary" type="submit" value="Insérez">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-0"></div>
    </div>
</div>

<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->


<?php require 'inc/footer.php'; ?>
