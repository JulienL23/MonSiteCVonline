<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site CV Julien</title>
        <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
        <link rel="stylesheet" href="css/bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style_admin.css">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="icon" href="img/hp.png">

        <?php
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
        $ligne_utilisateur = $sql->fetch();
        ?>
    </head>
    <body>
