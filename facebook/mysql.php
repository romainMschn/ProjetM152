<?php

function connectToDB() {
    static $connexion = null;
    if ($connexion == null) {
        try {
            $connexion = new PDO("mysql:host=localhost;port=3306;dbname=schema", "root");
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

function getPosts(){
        $connexion = connectToDB();
        try {
            $request = $connexion->prepare("SELECT post.idPost, post.commentaire FROM post ORDER BY post.datePost DESC ");
            $request->execute();

            return $request->fetchall(PDO::FETCH_ASSOC);

        } catch (Exception $ex) {
        echo $ex->getMessage();    
        }
}

function getImages($idPost){
    $connexion = connectToDB();
    try{
        $request = $connexion->prepare("SELECT media.nomMedia FROM media WHERE media.idPost=$idPost ");
        $request->execute();

        return $request->fetchall(PDO::FETCH_ASSOC);
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
}
