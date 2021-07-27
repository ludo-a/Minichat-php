<?php 
require('./src/connection.php');
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>Minichat</title>
</head>
<body>
    <form id="btnForm" action="minichat.php" method="get">
        <button id="butOldMessOn" type="submit" name="messOn">Afficher la conversation en entier</button>
        <button id="butOldMessOff" type="submit" name="messLast">Voir les derniers messages</button>
    </form>
    <!-- <hr width="20px"> -->
    <form method="post" action="./src/minichat_post.php" >
        <p>
            <label>Pseudo</label></br>
            <input type="text" name="pseudo" required>
        </p>  
        <p>
            <label>Message</label></br>
            <textarea name="message" cols="25" rows="3" required></textarea>
        </p>
        <button id="btnSend" type="submit">Envoyer</button>
    </form>
    <hr>
    <div id="container">
        <span class="point"> ...</span>


<!-- PHP -->
<?php
//Recuperation du nombre de comm & Param de comm que l'on veut afficher
$reqNbMess = $bdd->query('SELECT COUNT(id) as nbMess FROM minichat'); 
$compteur = $reqNbMess->fetch();
$reqNbMess->closeCursor();
$nbMessAfficher = 5;
$messageNumber = intval($compteur['nbMess']-$nbMessAfficher);
//Condition 
if($_SERVER['REQUEST_METHOD'] == "GET" AND isset($_GET['messOn'])){
    $reponse = $bdd->query("SELECT pseudo, message FROM minichat ORDER BY id");

    while($donnees = $reponse->fetch())
    {
     echo '<p class="message"><strong>' . $donnees['pseudo'] . '</strong> : ' . $donnees['message'] . '</p>';
    }
}else if($_SERVER['REQUEST_METHOD'] == "GET" AND isset($_GET['messLast']))
{
    //recup des derniers messages
    $reponse = $bdd->query("SELECT pseudo, message FROM minichat ORDER BY id LIMIT $messageNumber, $nbMessAfficher");

    while($donnees = $reponse->fetch())
    {
     echo '<p class="message"><strong>' . $donnees['pseudo'] . '</strong> : ' . $donnees['message'] . '</p>';
    }  
}else {
    //recup des derniers messages
    $reponse = $bdd->query("SELECT pseudo, message FROM minichat ORDER BY id LIMIT $messageNumber, $nbMessAfficher");

    while($donnees = $reponse->fetch())
    {
     echo '<p class="message"><strong>' . $donnees['pseudo'] . '</strong> : ' . $donnees['message'] . '</p>';
    }  
}
?>

<!-- HTML -->
    </div>
</body>
</html>