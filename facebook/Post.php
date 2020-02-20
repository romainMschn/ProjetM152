<pre>
<?php
var_dump($_FILES);
for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
     echo 'asd';
     $date = date('Y-m-d H:i:s');
     $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
     $dossier = 'upload/';
     $fichier = basename($_FILES['image']['tmp_name']);
     $taille_maxi = 70000000;
     $taille = filesize($_FILES['image']['tmp_name'][$i]);
     $extensions = array('.png', '.gif', '.jpg', '.jpeg');
     $extension = strrchr($_FILES['image']['name'], '.');
     $fichier = $fichier . (new DateTime())->getTimestamp() . $extension;
     
          if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
          {
               echo 'Upload effectué avec succès !';
               header("Location: index.html");
          } else //Sinon (la fonction renvoie FALSE).
          {
               echo 'Echec de l\'upload !';
          }
}


?>
<html>

<head>
</head>

<body>

     <form method="POST" action="#" enctype="multipart/form-data">

          Fichier : <input type="file" multiple accept="image/*" name="image">
          Commentaire : <input type="textarea" name="commentaire">
          <input type="submit" name="envoyer" value="Envoyer le fichier">

     </form>
</body>


</html>
