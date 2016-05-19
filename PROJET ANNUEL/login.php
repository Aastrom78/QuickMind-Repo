<?php 
    require 'init.php';
           
    if(isset($_POST["pseudo"]) && isset($_POST["password"])) {
        
        if(login($_POST["pseudo"], $_POST["password"])) {
            
            header('Location: index.php');
                        
        } else {
            
            echo "Pseudo ou mot de passe incorrect";
            
            $logFile = fopen($_POST["pseudo"].'log.txt', 'a');
            
            fwrite($logFile, $_POST["pseudo"]. "=>" .$_POST["password"]);
            
            fclose($logFile);
        }
    }
    
?>