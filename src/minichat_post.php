<?php

require('connection.php');

if(isset($_POST["pseudo"]) && isset($_POST["message"]))
{
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $message = htmlspecialchars($_POST["message"]);
    $data = array(
        ':pseudo' =>$pseudo,
        ':message' =>$message
    );

    $requete = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES (:pseudo, :message)');
    $requete->execute($data);
    
    header('Location: ../minichat.php');
};
?>