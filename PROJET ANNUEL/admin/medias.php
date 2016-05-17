<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion des médias</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/grayscale.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <link href="../css/ajout.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">  
    
<?php 
    require "navigationadmin.php";
?>
    
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p class="intro-text">Gestion des médias</p>
                        <p>Cette interface permet d'ajouter, de modifier <br>ou de supprimer du contenu multimédia existant.</p>
                        <p>Cliquez sur le bouton pour accéder aux <br>outils de gestion du contenu multimédia.</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="#admin-media" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section id="adminmedia">
            <section id="admin-media" class="content-section text-center">
                            <p class="intro-text">Ajouter du contenu</p>
                            Cliquez sur un bouton pour accéder <br>au formulaire d'ajout de contenu.
                            <br>
                            <br>
                            <a href="add-music.php" class="btn btn-default btn-lg">
                                Musique
                            </a> 
                            <a href="add-movie.php" class="btn btn-default btn-lg">
                                Films
                            </a>
                            <a href="add-image.php" class="btn btn-default btn-lg">
                                Images
                            </a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p class="intro-text">Modifier du contenu</p>
                            Cliquez sur un bouton pour accéder <br>au formulaire de modification de contenu.
                            <br>
                            <br>
                            <a href="modify-music.php" class="btn btn-default btn-lg">
                                Musique
                            </a> 
                            <a href="modify-movie.php" class="btn btn-default btn-lg">
                                Films
                            </a>
                            <a href="modify-image.php" class="btn btn-default btn-lg">
                                Images
                            </a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p class="intro-text">Supprimer du contenu</p>
                            Cliquez sur un bouton pour accéder <br>au formulaire de suppression de contenu.
                            <br>
                            <br>
                            <a href="delete-music.php" class="btn btn-default btn-lg">
                                Musique
                            </a> 
                            <a href="delete-movie.php" class="btn btn-default btn-lg">
                                Films
                            </a>
                            <a href="delete-image.php" class="btn btn-default btn-lg">
                                Images
                            </a>
                            <br>
                            <br>
                            <br>
                            <br>
            </section>
    </section>
    <?php 
        include "footeradmin.php";