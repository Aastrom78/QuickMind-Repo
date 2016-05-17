<?php 
    require 'init.php';
           
    if(isset($_POST["pseudo"]) && isset($_POST["password"])) {
        
        if(login($_POST["pseudo"], $_POST["password"])) {
            
            header("location : index.php");
            
            echo "connected"
;            
        } else {
            
            echo "failed";
            
            $logFile = fopen($_POST["pseudo"].'log.txt', 'a');
            
            fwrite($logFile, $_POST["pseudo"]. "=>" .$_POST["password"]);
            
            fclose($logFile);
            
            header("location : index.php");
        }
    }
    
?>