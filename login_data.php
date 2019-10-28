<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 03.10.2019
 * Time: 14:11
 */

//Connexion à la DB
include 'ConnectDB.php';

//Création de ces variable pour faciliter le code
$ulogin = @$_POST['uLogin'];
$upass = @$_POST['uPass'];

//Vérification si les champs sont vides
if (empty($ulogin) || empty($upass))
{
    header("Location:index.php");
}

//Récupération des données (si existante) en utilisant le login entré par l'utilisateur
$result = $blogitoDB->query("SELECT username, password, user_verified FROM users where username = '" . $ulogin . "'");
$row = $result->fetch();
$passwordDB = $row['password'];
$userVerified = $row['user_verified'];

//Vérification que la requête SQL retourne une valeur
if(empty($result)) {
    header("Location:index.php?qErrLog=true");
}

//Vérification que le mot de passe entré correspond au hash stocké dans la DB
if(!password_verify($upass, $passwordDB)){
    header("Location:index.php?qErrLog=true");
}

if($userVerified != 1) {
    header("Location:index.php?qVerified=false");
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Blogito - Login_data</title>
    <script src="./jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <p>

       Bonjour <?= $ulogin;?> ca va bro
        <br>
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>

