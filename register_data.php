<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 11:52
 */

//Connexion à la DB
include 'connectDB.php';

//Appel de la libraire PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

//Récupération des variables du formulaire d'inscription
$nuLogin = $_POST['nuLogin'];
$nuPass = $_POST['nuPass'];
$nuConfPass = $_POST['nuConfPass'];
$nuMail = $_POST['nuMail'];

// On vérifie la force de mot de passe. Ici, le mdp doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial
$uppercase = preg_match('@[A-Z]@', $nuPass);
$lowercase = preg_match('@[a-z]@', $nuPass);
$number = preg_match('@[0-9]@', $nuPass);
$specialChars = preg_match('@[^\w]@', $nuPass);

//Vérification que les champs soient tous remplis
if (empty($nuLogin) || empty($nuPass) || empty($nuMail) || empty($nuConfPass)) {
    header("Location:login.php?qErrRegister=0");
    exit();
}

//Vérification que l'adresse mail entrée ait un format valide (1 caractère avant et après le '@', la présence d'un '.' en deuxième partie ainsi qu'un caractère avant et après ce dernier
elseif (!filter_var($_POST['nuMail'], FILTER_VALIDATE_EMAIL)) {
    header("Location:login.php?qErrRegister=1");
    exit();
}

//Vérification que le mot de passe respectent les critères de sécurités + au minimum 8 caractères
elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($nuPass) < 8) {
    header("Location:login.php?qErrRegister=2");
    exit();
}

//Vérification que les deux mots de passent entrés soient identiques
elseif ($nuPass != $nuConfPass) {
    header("Location:login.php?qErrRegister=3");
    exit();
}

//Vérification que le login soit bien disponible. Si la requête retourne une valeur, alors le login est déjà pris
$result = $blogitoDB->query("SELECT username FROM users WHERE username ='" . $nuLogin . "';");
$row = $result->fetch();

if ($row['username'] == $nuLogin) {
    header("Location:login.php?qErrRegister=4");
    exit();
}

else {
    //Si aucun conflit, on insère le nouvel utilisateur dans la base de donnée en encryptant le mot de passe et en lui attribuant un code d'activation
    $passwordHashed = password_hash($_POST['nuPass'], PASSWORD_BCRYPT);
    $userActivationCode = md5(rand());
    $base_url = "http://localhost:81/Blogito/verifMail.php?code=" . $userActivationCode;    //On compose un lien contenant le code d'activation de l'utilisateur
    $blogitoDB->query("INSERT INTO users (id, username, password, email, admin, verification_code) VALUES (null,'" . $nuLogin . "', '" . $passwordHashed . "', '" . $nuMail . "', 0, '" . $userActivationCode . "');");

    //Appel des fichier pour PHPMailer
    require 'lib/PHPMailer/src/PHPMailer.php';
    require 'lib/PHPMailer/src/Exception.php';
    require 'lib/PHPMailer/src/SMTP.php';

    //Contenu du mail
    $mail_body = "<p>Bonjour " . $nuLogin . ",</p>
    <p>Veuillez ouvrir ce lien pour activer votre compte - " . $base_url ."
    <p>Meilleures salutations,<br />Blogito</p>";

    $mail = new PHPMailer;
    $mail->IsSMTP();        //Utilisation du protocole SMTP
    $mail->SMTPAuth = true; //Authentification pour utiliser le serveur mail requise
    $mail->SMTPSecure = 'ssl'; // transfer sécurisé avec le protocol ssl
    $mail->Host = "smtp.gmail.com"; //Adresse du serveur mail
    $mail->Port = 465; //Port du serveur mail
    $mail->Username = "email.blogito@gmail.com"; //Nom d'utilisateur pour l'authentification sur le serveur mail
    $mail->Password = 'M0t2Pa$$e'; //mot de passe associé
    $mail->CharSet = 'UTF-8'; //Encodage du texte de l'email
    $mail->From = 'email.blogito@gmail.com';   //Email affiché dans le message envoyé
    $mail->FromName = 'Blogito';     //Identifiant apparaîssant sur le mail
    $mail->AddAddress($nuMail, $nuLogin);  //Adresse d'envoi et username
    $mail->Subject = "Vérification de l'adresse email";   //Sujet du mail
    $mail->Body = $mail_body;       //Texte HTML du mail
    $mail->IsHTML(true);    //Configure l'interprétation du HTML
    $mail->Send(); //Envoi de l'email
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
    <title>Blogito - Inscription</title>
    <script src="./jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <p>
       Bonjour <?= $nuLogin;?> vous allez recevoir un mail pour valider votre compte
        <br>
        <a href="login.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>