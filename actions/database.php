<?php
try{
    $bdd = new PDO('mysql:host=localhost; dbname=forum_s; charset=utf8', 'root', '');
}catch(Exception $e){
    die('une erreur a été trouvée : ' . $e->getMessage());
}
