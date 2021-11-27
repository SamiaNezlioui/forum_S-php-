<?php

require('actions/database.php');
//*** validation du formulaire ***
if (isset($_POST['validate'])) {

    //*** Verifier si le pseudo est correct *** 
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

        //*** les données de l'utilisateur *** 
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);

        //*** Vérifier si l'utilisateur existe déja sur le site ***
        $chekIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo=?');
        $chekIfUserExists->execute(array($user_pseudo));

        if ($chekIfUserExists->rowCount() > 0) {
                 //*** Récupérer les données de l'utilisateur ***
            $infosUsers = $chekIfUserExists->fetch();

                 //*** verifier si le mot de passe est correcte ***
            if (password_verify($user_password, $infosUsers['password'])) {

                //*** verifier si l'utilisateur est authentifier ***
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['lastname'] = $userInfos['lastname'];
                $_SESSION['firstname'] = $userInfos['firstname'];
                $_SESSION['pseudo'] = $userInfos['pseudo'];

                //*** Redireger vers la page d'accueil ***
                header('location: index.php');
            } else {
                $messageError = "Votre mot de passe est incorrect!...";
            }
        } else {
            $messageError = "le pseudo saisi n'existe pas!...";
        }
    } else {
        $messageError = "Veuillez remplir tout les champs...";
    }
}
