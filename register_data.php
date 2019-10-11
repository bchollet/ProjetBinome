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
    header("Location:index.php?qErrRegister=0");
}

//Vérification que l'adresse mail entrée ait un format valide (1 caractère avant et après le '@', la présence d'un '.' en deuxième partie ainsi qu'un caractère avant et après ce dernier
elseif (!filter_var($_POST['nuMail'], FILTER_VALIDATE_EMAIL)) {
    header("Location:index.php?qErrRegister=1");
}

//Vérification que le mot de passe respectent les critères de sécurités + au minimum 8 caractères
elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($nuPass) < 8) {
    header("Location:index.php?qErrRegister=2");
}

//Vérification que les deux mots de passent entrés soient identiques
elseif ($nuPass != $nuConfPass) {
    header("Location:index.php?qErrRegister=3");
}

//Vérification que le login soit bien disponible. Si la requête retourne une valeur, alors le login est déjà pris
$result = $blogitoDB->query("SELECT username FROM users WHERE username ='" . $nuLogin . "';");
$row = $result->fetch();

if ($row['username'] == $nuLogin) {
    header("Location:index.php?qErrRegister=4");
}

//Si aucun conflit, on insère le nouvel utilisateur dans la base de donnée en encryptant le mot de passe et en lui attribuant un code d'activation
$passwordHashed = password_hash($_POST['nuPass'], PASSWORD_BCRYPT);
$userActivationCode = md5(rand());
$base_url = "http://localhost:81/Blogito/verifMail.php?code=" . $userActivationCode;    //On compose un lien contenant le code d'activation de l'utilisateur
$blogitoDB->query("INSERT INTO users (id, username, password, email, admin, verification_code) VALUES (null,'" . $nuLogin . "', '" . $passwordHashed . "', '" . $nuMail . "', 0, '" . $userActivationCode . "');");

require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/SMTP.php';

$mail_body = "<p>Bonjour " . $_POST['nuLogin'] . ",</p>
<p>Veuillez ouvrir ce lien pour activer votre compte - " . $base_url ."
<p>Meilleures salutations,<br />Blogito</p>
";

$mail = new PHPMailer;
$mail->IsSMTP();        //Sets Mailer to send message using SMTP
$mail->Host = 'mail.cpnv.ch';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
$mail->Port = '25';        //Sets the default SMTP server port
$mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
$mail->CharSet = 'UTF-8'; //Sets encoding
$mail->From = 'register@blogito.ch';   //Sets the From email address for the message
$mail->FromName = 'Blogito';     //Sets the From name of the message
$mail->AddAddress($nuMail, $nuLogin);  //Adds a "To" address
$mail->Subject = "Vérification de l'adresse mail";   //Sets the Subject of the message
$mail->Body = $mail_body;       //An HTML or plain text message body
$mail->IsHTML(true);    //Set text as HTML

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
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>