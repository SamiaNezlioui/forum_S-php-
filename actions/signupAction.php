<?php

require('actions/database.php');

if (isset($_POST['validate'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['lastname'])  && !empty($_POST['firstname'])
        && !empty($_POST['password'])){
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo ));

        if($checkIfUserAlreadyExists->rowCount() == 0){
             $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, password) VALUES(?,?,?,?)');
             $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));
           
        } else{
            $messageError = "l'utilisateur existe déja sur le site";
            }
    }  
    else {
    $messageError = "Veuillez remplir tout les champs...";
    }
}
