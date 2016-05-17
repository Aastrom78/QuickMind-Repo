<?php
   require "init.php";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">  
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
        <script type="text/javascript" src="code.js"></script>
    </head>
    <body>
        <?php
            if(!isUserConnected()) : 
        ?> 
       <button id="subscribe"">  s'inscrire  </button>
       <button id="connect"> Se connecter </button>
       <form id="subscribeForm"> 
            <br>
            <input type="text" name="pseudo" placeholder="Pseudo" id="nickNameSubscribe"> <br>
            <div class="subscribe_error_message"></div>
            
            <input type="email" name="email" placeholder="Email" id="emailSubscribe"> <br>            
            <div class="subscribe_error_message"></div>
            
            <input type="text" name="surname" placeholder="Surname" id="surnameSubscribe"> <br>            
            <div class="subscribe_error_message"></div>
            
            <input type="text" name="name" placeholder="Name" id="nameSubscribe"> <br>            
            <div class="subscribe_error_message"></div>
            
            <input type="password" name="password" placeholder="Password" id="passwordSubscribe"> <br>
            <div class="subscribe_error_message"></div>

            <input type="password" name="confirmPassword" placeholder="Password again" id="confirmPasswordSubscribe"> <br>
            <div class="subscribe_error_message"></div>
            
            <input type="radio"  name="kind" value="m" checked> homme
            <input type="radio"  name="kind" value="f"> femme <br>
            <div class="subscribe_error_message"></div>

            <input type="button" value="S'inscrire" onclick="subscribe()" >      
    </form>
    <script>
            $(function(){
                
                /* SHOW FORM */
                
                $('#subscribe').click(function() {
                    $('#connectForm').hide();
                    $('#subscribeForm').slideDown();
                })
            });
    </script>     
    <form method="" id="connectForm">
        <br>
        <input type="text" placeholder="Pseudo" id="nicknameConnect" >
        <input type="password" placeholder="Mot de passe" id="passwordConnect">
        <input type="button" value="Se connecter" onclick="login()">    
    </form>
        <script>
            $(function(){
            /* SHOW FORM */
            $('#connect').click(function() {
                $('#subscribeForm').hide();
                $('#connectForm').slideDown();
            })
            });
        </script>
       <?php
            else: 
       ?>
       <button id="logout" action="logout.php"> Logout</button>
       <?php
            endif;
       ?>
       
       
    </body>
    <footer>
    </footer>    
</html>
