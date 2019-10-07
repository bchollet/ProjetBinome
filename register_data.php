<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 11:52
 */

//Connexion à la DB
include 'connectDB.php';

// On vérifie la force de mot de passe. Ici, le mdp doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial
$nuPass = $_POST['nuPass'];
$uppercase = preg_match('@[A-Z]@', $nuPass);
$lowercase = preg_match('@[a-z]@', $nuPass);
$number = preg_match('@[0-9]@', $nuPass);
$specialChars = preg_match('@[^\w]@', $nuPass);

//Vérification que les champs soient tous remplis
if (empty($_POST['nuLogin']) || empty($_POST['nuPass']) || empty($_POST['nuMail']) || empty($_POST['nuConfPass'])) {
    header("Location:index.php?qErrRegister=1");
}

//Vérification que le mot de passe respectent les critères de sécurités + au minimum 8 caractères
elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($nuPass) < 8) {
    header("Location:index.php?qErrRegister=2");
}

//Vérification que les deux mots de passent entrés soient identiques
elseif ($_POST['nuPass'] != $_POST['nuConfPass']) {
    header("Location:index.php?qErrRegister=3");
}

//Vérification que l'adresse mail entrée ait un format valide (1 caractère avant et après le '@', la présence d'un '.' en deuxième partie ainsi qu'un caractère avant et après ce dernier
elseif (!filter_var($_POST['nuMail'], FILTER_VALIDATE_EMAIL)) {
    header("Location:index.php?qErrRegister=4");
}

//Si aucun conflit, on insère le nouvel utilisateur dans la base de donnée
else {
    $myPDO->query("INSERT INTO users (id, username, password, email, admin) VALUES (null,'" . $_POST['nuLogin'] . "', '" . $_POST['nuPass'] . "', '" . $_POST['nuMail'] . "', 0)");
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
       Bonjour <?= @$_POST['nuLogin'];?> vous allez recevoir un mail pour valider votre compte
        <br>
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>