<pre>
<?php

require_once 'mysql.php';

$commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);

if($commentaire != ""){
     $idPost = addPost($commentaire);
for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

     $date = date('Y-m-d H:i:s');
     
     $dossier = 'upload/';
     $fichier = basename($_FILES['image']['tmp_name'][$i]);
     $taille_maxi = 70000000;
     $taille = filesize($_FILES['image']['tmp_name'][$i]);
     $extensions = array('.png', '.gif', '.jpg', '.jpeg');
     $extension = strrchr($_FILES['image']['name'][$i], '.');
     $fichier = $fichier . (new DateTime())->getTimestamp() . $extension;


     $allowed = array('gif', 'png', 'jpg');
     $filename = $_FILES['image']['name'][$i];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     if (!in_array($ext, $allowed)) {
          echo 'error not an image';
     }else if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
          addMedia($extension,$fichier,$idPost);
          //header("Location: index.html");
     } else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
header('Location: index.php');
}




?>
<html>

<head>
</head>

<body>

     <form method="POST" action="#" enctype="multipart/form-data">

          Fichier : <input type="file" multiple accept="image/*" name="image[]">
          Commentaire : <input type="textarea" name="commentaire">
          <input type="submit" name="envoyer" value="Envoyer le fichier">

     </form>
</body>


</html>