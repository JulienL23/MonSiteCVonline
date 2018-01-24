<?php require 'head.php'; ?>
<body>
    <!-- NAV BARRE BOOTSTRAP -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Accueil</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="utilisateurs.php">Profil</a></li>
                            <li><a href="#">Modification</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Site<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../index.php">Retour au site</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parcours <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="experiences.php">Expériences</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="formations.php">Formations</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="realisations.php">Réalisations</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compétences & Loisirs <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="competences.php">Compétences</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="loisirs.php">Loisirs</a></li>
                        </ul>
                    </li>
                    <li><a href="messagerie.php">Messagerie</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo($ligne_utilisateur['pseudo']); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="loggin.php?quit=oui">Déconnexion</a></li>
                            <li><a href="../index.php?action=oui">Site Public</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
