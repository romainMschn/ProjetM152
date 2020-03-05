<?php

function connectToDB() {
    static $connexion = null;
    if ($connexion == null) {
        try {
            $connexion = new PDO("mysql:host=localhost;port=3306;dbname=Schema", "root", "tilttilT99$");
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    return $connexion;
}


function addPost($commentaire){
    $connexion = connectToDB();
    
    try {
        $request = $connexion->prepare("INSERT INTO post (commentaire) values ('$commentaire');");
        $request->execute();
    } catch (Exception $ex) {
    echo $ex->getMessage();    
    }
    
    return $connexion->lastInsertId();
}

function addMedia($typeMedia,$nomMedia,$idPost){
    $connexion = connectToDB();
    try{
        $request = $connexion->prepare("INSERT INTO media (typeMedia,nomMedia,idPost) values ('$typeMedia','$nomMedia','$idPost')");
        $request->execute();
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
}
