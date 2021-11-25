<?php

require('actions/database.php');
//validation du formulaire
if (isset($_POST['validate'])) {
    
    //Verifier si l'utilisateur a bien remplis tous les champs
    if (!empty($_POST['pseudo']) && !empty($_POST['lastname'])  && !empty($_POST['firstname'])
        && !empty($_POST['password'])){

    //Vérifier si l'utilisateur existe déja sur le site
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//verifier si l'utilisateur existe dans la base données
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo ));

        if($checkIfUserAlreadyExists->rowCount() == 0){
            //inserer l'utulisateur dans la BDD
             $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, password) VALUES(?,?,?,?)');
             $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));
           //recuperer les infos de l'utilisateur
             $getInfosOfThisUserReq = $bdd->prepare('SELECT id,pseudo, nom, prenom FROM users WHERE nom =? AND prenom=? AND pseudo =?');
             $getInfosOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_pseudo));
            
             //Authentifier l'utilisateur sur le site et récupérer les données 
             $userInfos =  $getInfosOfThisUserReq->fetch();
             $_SESSION['auth'] = true;
             $_SESSION['id'] = $userInfos['id'];
             $_SESSION['lastname'] = $userInfos['lastname'];
             $_SESSION['firstname'] = $userInfos['firstname'];
             $_SESSION['pseudo'] = $userInfos['pseudo'];

//Rediriger l'utilisateur vers la page d'accueil
             header('location: index.php');

        } else{
            $messageError = "l'utilisateur existe déja sur le site";
            }
    }  
    else {
    $messageError = "Veuillez remplir tout les champs...";
    }
}
