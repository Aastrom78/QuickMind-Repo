<?php 
    require "headeradmin.php"; 
    require "navigationadmin.php";   
?>

    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p class="intro-text">Bienvenue sur le panneau d'administration de QuickMind.</p>
                        <br>
                        <br>
                        <p>Vous êtes reconnu comme un administrateur du site et <br>vous disposez de droits privilégiés.</p>
                        <p>Les administrateurs ont la capacité d'altérer les données relatives aux joueurs, ainsi que le contenu multimédia qui le leur est diffusé.</p>
                        <p>Cliquez sur le bouton pour accéder <br>aux deux interfaces de gestion de QuickMind.</p>
                        <br>
                        <br>
                        <a href="#admin" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="admin">
            <section id="adminall" class="content-section text-center">
                            <a href="users.php"><button class="button">
                            <h4>Gérer les joueurs</h4>
                            <p class="intro-text">Vous trouverez ici l'interface de gestion <br>des joueurs inscrits sur QuickMind.</p>
                            </button></a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a href="medias.php"><button class="button" href="medias.php">
                            <h4>Gérer les médias</h4>
                            <p class="intro-text">Vous trouverez ici l'interface de gestion <br>des médias hébergés sur QuickMind.</p>
                            </button></a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
            </section>
    </section>
    
   <?php 
        include "footeradmin.php";
   ?>
