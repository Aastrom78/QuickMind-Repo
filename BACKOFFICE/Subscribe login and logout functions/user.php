<?php
    require 'header.php';
    
    $db = getDb();
    $stmt = $db -> prepare ('SELECT pseudo, email, name, surname, gender FROM Users');
    $stmt -> execute();
   
   
   
?>

<button id='getUsersButton' onclick=''>
Rechercher <input type='text' id='searchUser' placeholder='Entrer pseudo ou adresse email'> <br>



<?php
    require 'footer.php';
?>