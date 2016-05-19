<?php

require 'init.php';

if(isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["password"]) &&
    isset($_POST["kind"])) {  
    $nickname = $_POST["pseudo"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $kind = $_POST["kind"];
    $accesstoken = md5(uniqid());

    $db = connectDb();
    $stmt = $db -> prepare("SELECT pseudo FROM Users WHERE pseudo = ?");
    $args = [$nickname];
    $stmt -> execute($args);
    $error;
        
    if(empty($stmt->fetch())) {
        
        $db = connectDb();
        $stmt = $db -> prepare("SELECT email FROM Users WHERE email = ?");
        $args = [$email];
        $stmt -> execute($args);
        
        if(empty($stmt->fetch())) {
            
            $db = connectDb();
        
            $stmt = $db->prepare("INSERT INTO users (pseudo, name, surname, email, password, gender, accesstoken) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $args = array($nickname, $name, $surname, $email, password_hash($password, PASSWORD_DEFAULT), $kind, $accesstoken);
            $stmt -> execute($args);
        
            echo "Inscription effectuée, vous allez recevoir un mail pour confirmer votre inscription";
        
            $url = "http://".$_SERVER["SERVER_NAME"]."/PROJETANNUEL/validemail.php?accesstoken=".$accesstoken;
            $from = "l.rodrigues.david@gmail.com"; /*NEED TO BE THE WEBSITE EMAIL*/
            $to = $_POST['email'];
            $subject = "Validation de l'inscription";
            $body = "Clicker ici pour activer ".$url;
            $headers = 'From: '.$from . "\r\n" .'$from: '.$from . "\r\n" .'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $body);
          
        }  else {
            $error = "Email déja existant";
            echo $error; 
        }
    } else {
        $error = "Pseudo déja existant";
        echo $error; 
    }
}  
?>




