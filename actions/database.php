<?php
try{
    session_start();
    $bdd = new PDO('mysql:host=localhost; dbname=forum_s; charset=utf8', 'root', '');
    
    //*** Gestion des erreurs BDD ***
  //  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}catch(Exception $e){
    die('une erreur a été trouvée : ' . $e->getMessage());
}
