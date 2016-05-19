<?php

function connectDb(){

	try{
		$db = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST,DBUSER,DBPWD);
	}catch(Exception $e){
		die("Erreur SQL : ".$e->getMessage());
	}

	return $db;
}

function emailExist($email){
    
	$db = connectDb();

	$query = $db->prepare(" SELECT id FROM users WHERE email=:email ");
	$query->execute(["email" => $email]);
	$result = $query->fetch();
	
	if(empty($result)){
		return false;
	}

	return true;
}

function mediaExist ($media) {
	
	$db = connectDb();

	$query = $db->prepare(" SELECT id_medias FROM medias WHERE title=:title");
	$query->execute(["title" => $media]);
	$result = $query->fetch();
	
	if(empty($result)){
		return false;
	}
	return true;
}

function login ($pseudo, $password) {
    
    if(isset($pseudo) && isset($password)) {
        
        $db = connectDb();
        
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

function generateAccessToken ($pseudo) {
    
    $accesstoken = md5(uniqid());
    
    $db = connectDb();
    $stmt = $db->prepare("UPDATE Users SET accesstoken = ? WHERE pseudo = ?");
    $args = array($accesstoken, $pseudo);
    $stmt->execute($args);
    return $accesstoken;
    
}

function isUserConnected () {
    
    if(!empty($_SESSION["accesstoken"]) && !empty($_SESSION["pseudo"])) {
        
        $db = connectDb();
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

