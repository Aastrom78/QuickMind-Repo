<?php

Function getDb() {

	try {
		
		$db = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST,DBUSER,DBPWD);

	} catch (Exception $ex) {

		die("Erreur SQL : ".$ex -> getMessage());
	}


	return $db;
}

function generateAccessToken ($pseudo) {
    
    $accesstoken = md5(uniqid());
    
    $db = getDb();
    $stmt = $db->prepare("UPDATE Users SET accesstoken = ? WHERE pseudo = ?");
    $args = array($accesstoken, $pseudo);
    $stmt->execute($args);
    return $accesstoken;
    
}

function isUserConnected () {
    
    if(!empty($_SESSION["accesstoken"]) && !empty($_SESSION["pseudo"])) {
        
        $db = getDb();
        $stmt = $db -> prepare ("SELECT pseudo FROM Users WHERE pseudo = ? AND accesstoken = ?");
        $args = array($_SESSION["pseudo"], $_SESSION["accesstoken"]);
        $stmt->execute($args);
        $result = $stmt->fetch();
                
        if(!empty($result)) {
            $_SESSION["accesstoken"]= generateAccessToken($_SESSION["pseudo"]);
            return true;
        }
    }
    
    return false;
}

function login($pseudo, $password) {
    
    if(isset($pseudo) && isset($password)) {
        
        $db = getDb();
        
        $stmt = $db -> prepare("SELECT password FROM Users WHERE pseudo = ? AND is_valid = 1");
        $args = array($pseudo);
        $stmt -> execute ($args); 
        $result = $stmt -> fetch();
        
        if(!empty($result)) {
            $_SESSION["accesstoken"] = generateAccessToken($pseudo);
            $_SESSION["pseudo"] = $pseudo; 
            return true;
        }   
    }
    return false;
}

function logout () {
    
    unset($_SESSION["accesstoken"]);
    
    header("location : index.php");
}
