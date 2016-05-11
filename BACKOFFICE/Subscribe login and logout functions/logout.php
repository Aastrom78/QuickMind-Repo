<?php
    require 'init.php';
    
    unset($_SESSION["accesstoken"]);
    header("location: index.php");
    
?>