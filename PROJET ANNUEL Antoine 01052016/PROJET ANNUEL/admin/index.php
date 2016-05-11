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
                            <a href="users.php" class="btn btn-default btn-lg">
                            <br>
                            <h4>Gérer les joueurs</h4>
                            Vous trouverez ici l'interface de gestion <br>des joueurs inscrits sur QuickMind.<br><br>Vous pouvez modifier, supprimer, élever ou retirer les<br> privilèges d'un joueur.
                            <br>
                            <br>
                            </a>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a href="medias.php" class="btn btn-default btn-lg">
                            <br>
                            <h4>Gérer les médias</h4>
                            Vous trouverez ici l'interface de gestion <br>des médias hébergés sur QuickMind.<br><br>Vous pouvez ajouter, modifier ou supprimer du contenu.</p>
                            </a>
                            <br>
                            <br>
                            <br>
            </section>
    </section>
    
   <?php 
        include "footeradmin.php";
   ?>
