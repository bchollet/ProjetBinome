<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 03.10.2019
 * Time: 14:11
 */

//Connexion à la DB
include 'ConnectDB.php';
session_start();

//Création de ces variable pour faciliter le code
$ulogin = @$_POST['uLogin'];
$upass = @$_POST['uPass'];

//Vérification si les champs sont vides
if (empty($ulogin) || empty($upass))
{
    header("Location:login.php?qErrLog=true");
    exit();
}

//Récupération des données (si existante) en utilisant le login entré par l'utilisateur
$result = $blogitoDB->query("SELECT username, password, admin, user_verified FROM users where username = '" . $ulogin . "'");
$row = $result->fetch();
$passwordDB = $row['password'];
$userVerified = $row['user_verified'];
$isAdmin = $row['admin'];


//Vérification que la requête SQL retourne une valeur
if(empty($row)) {
    header("Location:login.php?qErrLog=true");
    exit();
}

//Vérification que le mot de passe entré correspond au hash stocké dans la DB
if(!password_verify($upass, $passwordDB)){
    header("Location:login.php?qErrLog=true");
    exit();
}

//Vérification que l'utilisateur existe
if($userVerified != 1) {
    header("Location:login.php?qErrVerif=true");
    exit();
}

//Attribution de la variable session au nom de l'utilisateur
$_SESSION['username'] = $row['username'];
$_SESSION['isLogged'] = true;

//Vérification si l'utilisateur est un admin.
if($isAdmin == 1) {
    $_SESSION['admin'] = true;
    header("Location:admin.php");
    exit();
}
else {
    $_SESSION['admin'] = false;
    header("Location:index.php?user=" . $_SESSION['username']);
    exit();
}
?>

