<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 03.10.2019
 * Time: 14:11
 */

//Connexion à la DB
include 'ConnectDB.php';

$result = $myPDO->query("SELECT username FROM users where username = '" . $_POST['uLogin'] . "'");

//Création de ces variable pour faciliter le code
$ulogin = @$_POST['uLogin'];
$upass = @$_POST['uPass'];
//Vérification si les champs sont vides
if (empty($_POST['uLogin']) || empty($_POST['uPass']))
{
    header("Location:index.php");
}

$result = $myPDO->query("SELECT password FROM users WHERE username ='" . $ulogin . "'");

foreach ($result as $row){
    //Debug
    echo '<script>console.log("'.$row['password'].'")</script>';
    //Création de la variable passwordDB contenant la ligne du mot de passe de l'user
    $passwordDB = $row['password'];
}


if($passwordDB != $upass){
    header("Location:index.php");
    //Debug
    echo '<script>console.log("'.$upass.'")</script>';
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

       Bonjour <?= @$_POST['uLogin'];?> ca va bro
        <br>
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>

