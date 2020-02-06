
<html> 
<head>
    <body>

        <form method="POST" action="#" enctype="multipart/form-data">

            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            Fichier : <input type="file" name="image">
            Commentaire : <input type="text" name="commentaire">
            <input type="submit" name="envoyer" value="Envoyer le fichier">

        </form>
    </body>
</head>

</html>

<?php
$myPDO = new PDO('mysql:host=localhost;dbname=mariadb', 'root', 'tilttilT99$');
$result = $myPDO->query("INSERT INTO < table name > (col1,col2,col3...col n)
VALUES (value1,value2,value3…value n)");


$commentaire = filter_input(INPUT_POST,"commentaire",FILTER_SANITIZE_STRING);
$dossier = 'upload/';
$fichier = basename($_FILES['image']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['image']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
          header("Location: index.html");
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}

?>