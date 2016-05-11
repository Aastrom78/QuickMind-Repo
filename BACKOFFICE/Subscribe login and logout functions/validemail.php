<?php
if( $_GET["accesstoken"] == null || strlen($_GET["accesstoken"]) != 32 ) {
    die("error accesstoken not valid or not send");
}

$db = getDb();
$stmt = $db->prepare("SELECT pseudo FROM Users WHERE accesstoken = ?");
$args = array($_GET["accesstoken"]);
$stmt-> execute($args);
$result = $stmt -> fetch();

if(!empty($result)) {
    $db = getDb();
    $stmt = $db->prepare("UPDATE Users SET is_valid = '1' where accesstoken = ?");
    $args = array($_GET["accesstoken"]);
    $stmt->execute($args);
    echo "Inscription valider";
    
} else {
    die("error user not found");
}
