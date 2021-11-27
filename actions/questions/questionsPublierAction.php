<?php
require('actions/database.php');

if(isset($_POST['validate'])){

    if(!empty($_POST['title']) AND !empty($_POST['description'] AND !empty($_POST['content']))){
  $question_title = htmlspecialchars($_POST['title']);
  $question_description = nl2br(htmlspecialchars($_POST['description']));
  $question_content = nl2br(htmlspecialchars($_POST['content']));
  $question_date = date('d/m/Y');
  $question_id_author = $_SESSION['id'];
  //$question_pseudo_author = $_SESSION['pseudo'];

 $insertQuestionOnWebsite = $bdd->prepare('INSERT INTO questions(titre, description, contenu, date_publication, id_auteur) VALUES (?,?,?,?,?)');
 $insertQuestionOnWebsite->execute(
     array(
         $question_title ,
         $question_description,
         $question_content,
         $question_date,
         $question_id_author
         
        // $question_pseudo_author
        )
    );

 $successMsg = "votre question est bien publiée...";
 
    } else{
        $messageError= "Veuillez remplir tout les champs...";
    }
}