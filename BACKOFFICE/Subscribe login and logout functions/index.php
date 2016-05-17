<?php
    require 'header.php';
    if(!isUserConnected()) : 
?>
<ul> 
<li id="subscribe">  s'inscrire  </li>
<li id="connect"> Se connecter </li>
</ul>
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
            
            $('#subscribe').hover(function() {
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
        $('#connect').hover(function() {
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
        require 'footer.php';
    ?>
    
    
