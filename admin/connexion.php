<?php

$hote = 'julienlezqju2017.mysql.db'; // le chemin vers le Server
$bdd = 'julienlezqju2017'; // le nom de la bdd
$utilisateur = 'julienlezqju2017'; // le nom d'utilisateur pour se connecter
$passe = '1433Ledoux'; // mdp de l'utilisateur local PC

$pdoCV = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $passe, array
    (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// $pdoCV est le nom de la variable de la connexion qui sert partout où l'on doit se servir de cette connexion

