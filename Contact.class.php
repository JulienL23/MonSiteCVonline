<!-- /* Etape 4 - Contact.class.php */
/*
 * Une classe c'est en fait un plan à partir duquel on va pouvoir créer plusieurs objets
 * un peu comme un moule dont on en obtient comme objets des gâteaux
 *
 * Une classe peut contenir plusieurs méthodes (ou fonctions)
 * par ex. une classe voiture peut avoir comme méthodes 'freiner' et 'accélerer'
 * et quand je créé un objet de la classe voiture, par ex. un 308 ou une porsche qui auront les
 * fonctionnalités de la classe voiture comme 'freiner' et 'accélerer'
 */

<?php

class Contact {

    // déclaration des variables = champs de la table t_commentaires.sql
    private $nom;
    private $email;
    private $sujet;
    private $message;
    // Bonus - pour l'email
    private $to;
    private $headers;
    private $pdoCV;

    // fonction d'insertion en BDD
    public function insertContact($co_nom, $co_email, $co_sujet, $co_message) {
        // on récupère les données rentrées par l'utilisateur
        $this->nom = strip_tags($co_nom);
        $this->email = strip_tags($co_email);
        $this->sujet = strip_tags($co_sujet);
        $this->message = strip_tags($co_message);

/*        // appelle la connexion à la BDD
        //require('admin/connexion.php');
        $hote = 'localhost'; // le chemin vers le Server
        $bdd = 'site_cv'; // le nom de la bdd
        $utilisateur = 'root'; // le nom d'utilisateur pour se connecter
        $passe = ''; // mdp de l'utilisateur local PC

        $pdoCV = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $passe, array
            (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));*/


        $hote = 'julienlezqju2017.mysql.db'; // le chemin vers le Server
        $bdd = 'julienlezqju2017'; // le nom de la bdd
        $utilisateur = 'julienlezqju2017'; // le nom d'utilisateur pour se connecter
        $passe = '1433Ledoux'; // mdp de l'utilisateur local PC

        $pdoCV = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $passe, array
    (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        // on crée une requête puis on l'exécute
        $req = $pdoCV->prepare('INSERT INTO t_commentaires (co_nom, co_email, co_sujet, co_message) VALUES (:nom, :email, :sujet, :message)');

        $req->execute([
            ':nom' => $this->nom, //on attribue à la variable co_nom la valeur de l'objet en cours d'instanciation, le nom de l'auteur du message qui vient d'^tre posté
            ':email' => $this->email,
            ':sujet' => $this->sujet,
            ':message' => $this->message]);

        // on ferme la requête pour protéger des injections
        $req->closeCursor();
    }

    // Bonus - envoi d'un email
    public function sendEmail($co_sujet, $co_email, $co_message) {
        $this->to = 'julien.ledoux@lepoles.com';
        $this->email = strip_tags($co_email);
        $this->sujet = strip_tags($co_sujet);
        $this->message = strip_tags($co_message);
        $this->headers = 'From: ' . $this->co_email . "\r\n"; //retours à la ligne
        $this->headers .= 'MIME-version: 1.0' . "\r\n";
        $this->headers .= 'Content-type : text/html; charset=utf-8' . "\r\n";

        // on utilise la fonction mail() de PHP
        mail($this->to, $this->email, $this->sujet, $this->message, $this->headers);
    }

}
