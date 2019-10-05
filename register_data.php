<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 11:52
 */

//Connexion à la DB
include 'connectDB.php';

if (empty($_POST['nuLogin']) || empty($_POST['nuPass']) || empty($_POST['nuMail']) || empty($_POST['nuConfPass']))
{
    header("Location:index.php?qErrRegister=1");
}
else {
    $result = $myPDO->query("INSERT INTO users (id, username, password, email, admin) VALUES (null,'" . $_POST['nuLogin'] . "', '" . $_POST['nuPass'] . "', '" . $_POST['nuMail'] . "', 0)");
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