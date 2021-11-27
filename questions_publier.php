<?php 
require('actions/questions/questionsPublierAction.php');
require('actions/users/securityAction.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<body>
  <?php include 'includes/navbar.php';?>  
  
<br><br>
    <form class="container" method="POST">
        <?php 
        if(isset($messageError)) {
                 echo '<p>' . $messageError . '</p>';
            } elseif(isset($successMsg)){
                 echo '<p>' . $successMsg. '</p>';
            }
            ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Titre de la question</label>
            <input type="text" class="form-control" name="title">
        </div>
        <br><br>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description de la question</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <br><br>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contenu de la question</label>
            <textarea class="form-control" name="content"></textarea>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary" name="validate">publier la question</button>
    </form>
</body>
</html>