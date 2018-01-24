<?php
require 'admin/connexion.php';


$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
$ligne_utilisateur = $sql->fetch();

$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE utilisateur_id ='1'");
$ligne_competences = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_realisations WHERE utilisateur_id ='1'");
$ligne_realisations = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE utilisateur_id ='1'");
$ligne_experience = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_formations WHERE utilisateur_id ='1'");
$ligne_formation = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE utilisateur_id ='1'");
$ligne_loisirs = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr" >
    <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111508912-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111508912-1');
</script>

        <meta charset="UTF-8">
        <meta name="description" content="Développeur et intégrateur web.">
        <meta name="author" lang="fr" content="Julien LEDOUX">
        <meta name="keywords" lang="fr" content="développeur, intégrateur, javascript, php, html, css, wordpress, bootstrap, graphisme">
        <title>Julien Ledoux</title>
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One|Source+Sans+Pro:400" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


        <link rel="stylesheet" href="css/style.css">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="css/agency.min.css" rel="stylesheet">
        <!--Icon-->
        <link rel="icon" href="img/logo.png">


    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><?= $ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']; ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#competences">Compétences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#formation">Expériences & Formations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#interet">Intérêts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- HEADER -->
        <header class="masthead">
            <div class="container">
                <div class="intro-text">
                    <div id="nomtitre" class="intro-lead-in"><?= $ligne_utilisateur['prenom'] . ' ' . $ligne_utilisateur['nom']; ?></div>
                    <div class="intro-heading text-uppercase"><p id="grostitre"><span id="holder"></span></p></div>
                    <div class="social-container">
                        <ul class="social-icons">
                            <li><a target="_blank" href="https://github.com/JulienL23"><i id="effet" class="fa fa-github-square"></i></a></li>
                            <li><a target="_blank" href="https://www.facebook.com/julien.ledoux.16503"><i id="effet3" class="fa fa-facebook-square"></i></a></li>
                            <li><a target="_blank" href="https://www.linkedin.com/in/julien-ledoux-932585145/"><i id="effet4" class="fa fa-linkedin"></i></a></li>
                            <li><a target="_blank" href="https://codepen.io/Picsou23/"><i id="effet5" class="fa fa-codepen"></i></a></li>
                        </ul>
                    </div>
                    <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">Mais encore !</a>
                </div>
            </div>
        </header>
        <!-- PORTFOLIO -->
        <section class="bg-light" id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Portfolio</h2>
                        <h3 class="section-subheading text-muted">Voila quelques réalisations.</h3>
                    </div>

                    <div class="row">
                        <?php foreach ($ligne_realisations as $ligne_realisation) : ?>
                            <div class="col-md-4 col-sm-6 portfolio-item">
                                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?= $ligne_realisation['id_realisation'] ?>">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content">
                                            <i class="fa fa-plus fa-3x"></i>
                                        </div>
                                    </div>
                                    <img class="img-fluid" src="<?= $ligne_realisation['r_photo'] ?>" alt="">
                                </a>
                                <div class="portfolio-caption">
                                    <h4><?= $ligne_realisation['r_titre'] ?></h4>
                                    <p class="text-muted"><?= $ligne_realisation['r_soustitre'] ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- FIN PORTFOLIO -->

        <!--service -->
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Services</h2>
                        <h3 class="section-subheading text-muted">Voici quelques services que je propose.</h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet2" class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Création de Site</h4>
                        <p class="text-muted">VITRINE si vous souhaitez donner une visibilité à votre activité ou entreprise sur internet.</p>
                        <p class="text-muted">E-COMMERCE pour étendre votre entreprise sur internet.</p>
                        <p class="text-muted">RESEAU SOCIAL ( avec tchat ) pour avoir votre mini reseau pour vous et vos proches.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet6" class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Responsive Design</h4>
                        <p class="text-muted">Possibilité de rendre responsive votre site pour qu'il soit aussi adapté sur tablette et téléphone.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet7" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Sécurité</h4>
                        <p class="text-muted">Le hacking devenant à la mode, j'ai possibilité d'accentuer le niveau de sécurité de votre site.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- FIN service -->

        <!-- competence -->
        <section id="competences">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Compétences</h2>
                        <h3 class="section-subheading text-muted">En ce moment je me perfectionne en JavaScript et graphisme.</h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet8" class="fa fa-code fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Intégration et développement</h4>
                        <p class="text-muted"></p>
                        <p class="text-muted">HTML5, CSS3, JAVASCRIPT</p>
                        <p class="text-muted">MySQL, PHP, AJAX</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet9" class="fa fa-book fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Framework, Library et CMS </h4>
                        <p class="text-muted">Bootstrap, Silex</p>
                        <p class="text-muted">jQuery, jQuery UI</p>
                        <p class="text-muted">Wordpress</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i id="effet10" class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Graphisme</h4>
                        <p class="text-muted">Photoshop, InDesign, Illustrator</p>
                        <p class="text-muted">Création de maquette, logo, flyers ...</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- FIN competence -->

        <!-- EXPERIENCES ET FORMATIONS -->
        <section id="formation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Expériences & Formations</h2>
                        <h3 class="section-subheading text-muted">Voila mon parcourt en bref.</h3>
                    </div>
                </div>
            </div>
        </section>
        <section id="timeline">

            <div class="tl-item">

                <div class="tl-bg" style="background-image: url(img/fond1.jpg)"></div>

                <div class="tl-year">
                    <p class="f2 heading--sanSerif"><?= $ligne_experience[1]['e_dates'] ?></p>
                </div>

                <div class="tl-content">
                    <h1 class="f3 text--accent ttu"><?= $ligne_experience[1]['e_titre'] ?></h1>
                    <h3><?= $ligne_experience[1]['e_soustitre'] ?></h3>
                    <?= $ligne_experience[1]['e_description'] ?>
                </div>

            </div>

            <div class="tl-item">

                <div class="tl-bg" style="background-image: url(img/fond2.jpg)"></div>

                <div class="tl-year">
                    <p class="f2 heading--sanSerif"><?= $ligne_formation[1]['f_dates'] ?></p>
                </div>

                <div class="tl-content">
                    <h1 class="f3 text--accent ttu"><?= $ligne_formation[1]['f_titre'] ?></h1>
                    <h3><?= $ligne_formation[1]['f_soustitre'] ?></h3>
                    <?= $ligne_formation[1]['f_description'] ?>
                </div>

            </div>

            <div class="tl-item">

                <div class="tl-bg" style="background-image: url(img/fond1.jpg)"></div>

                <div class="tl-year">
                    <p class="f2 heading--sanSerif"><?= $ligne_experience[0]['e_dates'] ?></p>
                </div>

                <div class="tl-content">
                    <h1 class="f3 text--accent ttu"><?= $ligne_experience[0]['e_titre'] ?></h1>
                    <h3><?= $ligne_experience[0]['e_soustitre'] ?></h3>
                    <?= $ligne_experience[0]['e_description'] ?>
                </div>

            </div>

            <div class="tl-item">

                <div class="tl-bg" style="background-image: url(img/fond2.jpg)"></div>

                <div class="tl-year">
                    <p class="f2 heading--sanSerif"><?= $ligne_formation[0]['f_dates'] ?></p>
                </div>

                <div class="tl-content">
                    <h1 class="f3 text--accent ttu"><?= $ligne_formation[0]['f_titre'] ?></h1>
                    <h3><?= $ligne_formation[0]['f_soustitre'] ?></h3>
                    <?= $ligne_formation[0]['f_description'] ?>
                </div>

            </div>
        </section>
        <!-- DOWNLOAD CV -->

        <div class="containeur">
            <a href="img/cv_julien2.pdf" target="_blank"> <button type="submit">Mon CV papier !</button></a>
        </div>


        <!-- FIN DOWNLOAD CV -->
        <!-- INTERETS -->
        <section class="bg-light" id="interet">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Intérêts</h2>
                        <h3 class="section-subheading text-muted">Quelques indices sur ma personnalité et mes hobbies.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <?php foreach ($ligne_loisirs as $ligne_loisir) : ?>
                        <div class="col-sm-2">
                            <div class="team-member">
                                <img alt="Julien Ledoux Loisir" class="mx-auto rounded-circle" src="<?= $ligne_loisir['photo'] ?>">
                                <h4><?= $ligne_loisir['loisir'] ?></h4>
                                <p class="text-muted"><?= $ligne_loisir['accroche'] ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
        <!-- FIN INTERET -->
        <?php
// on récupère la classe Contact
        require('Contact.class.php');

// on vérifie que le formulaire a été posté
        if (!empty($_POST)) {
            // on éclate le $_POST en tableau qui permet d'accéder directement au champs par des variables
            var_dump($_POST);
            extract($_POST);

            // on effectue une validation des données du formulaire et on vérifie la validité de l'email
            $valid = (empty($nom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($sujet) || empty($message)) ? false : true; // écriture ternaire pour if / else

            $erreurnom = (empty($nom)) ? 'Indiquez votre nom' : null;
            $erreuremail = (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) ? 'Entrez un email valide' : null;
            $erreursujet = (empty($sujet)) ? 'Indiquez un sujet' : null;
            $erreurmessage = (empty($message)) ? 'Parlez donc !!' : null;

            // si tous les champs correctement renseignés
            if ($valid) {
                // on crée un nouvel objet (ou une instance) de la class Contact.class.php
                $contact = new Contact();
                // on utilise la méthode insertContact pour insérez en BDD
                $contact->insertContact($nom, $email, $sujet, $message);
            }
        }
// on utilise la méthode sendMail de la classe Contact.class.php
//$contact->sendEmail($sujet, $email, $message);
// on efface les valeurs du formulaires
        unset($nom);
        unset($sujet);
        unset($message);
        unset($email);
        unset($contact);

// on créé une variable de succès
        $success = 'Message envoyé !';
        ?>

        <!-- Contact rapide -->
        <section class="py-5" >
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12" ></div>
                    <div class="col-md-7 col-sm-12">
                        <p><i class="fa fa-envelope" aria-hidden="true"></i><?= ' ' . $ligne_utilisateur['email'] ?></p>
                    </div>
                    <div class="col-md-1 col-sm-12" ></div>
                </div>
            </div>
        </section>


        <!-- Contact -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Contact</h2>
                        <h3 class="section-subheading text-muted">N'hésitez pas à me contacter !</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="index.php#contact" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" name="nom" value="<?php if (isset($nom)) echo $nom; ?>" type="text" placeholder="Votre nom *" required data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="email" value="<?php if (isset($email)) echo $email; ?>" type="email"  placeholder="Votre email *" required data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="sujet" value="<?php if (isset($sujet)) echo $sujet; ?>" type="tel" placeholder="Votre telephone *" required data-validation-required-message="Please enter your phone number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message"  placeholder="Votre message *" required data-validation-required-message="Please enter a message."><?php if (isset($message)) echo $message; ?></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <span id="copyright" class="copyright">Tous droits réservés &copy; 2017</span>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://github.com/JulienL23" target="_blank">
                                    <i class="fa fa-github"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/julien.ledoux.16503" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/julien-ledoux-932585145/" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://codepen.io/Picsou23/" target="_blank">
                                    <i class="fa fa-codepen"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline quicklinks">
                            <li class="list-inline-item">
                                <a href="admin/index.php">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Portfolio Modals -->

        <!-- Modal 1 -->
        <?php foreach ($ligne_realisations as $ligne_realisation) : ?>
            <div class="portfolio-modal modal fade" id="portfolioModal<?= $ligne_realisation['id_realisation'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                                <div class="rl"></div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="modal-body">
                                        <!-- Project Details Go Here -->
                                        <h2 class="text-uppercase"><?= $ligne_realisation['r_titre'] ?></h2>
                                        <p class="item-intro text-muted"><?= $ligne_realisation['r_soustitre'] ?></p>
                                        <img alt="Julien Ledoux Realisation" class="img-fluid d-block mx-auto" src="<?= $ligne_realisation['r_photo'] ?>">
                                        <?= $ligne_realisation['r_description'] ?>
                                        <button class="btn btn-primary" data-dismiss="modal" type="button">
                                            <i class="fa fa-times"></i>
                                            Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Contact form JavaScript -->
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>

        <!-- Custom scripts for this template -->

        <script src="js/agency.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!-- Animation download CV -->
        <!-- FIN animation download CV -->

        <!--Animation titre site-->
        <script src="js/title.js"></script>

    </body>
</html>
