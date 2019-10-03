<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 03.10.2019
 * Time: 14:11
 */
session_start();

if (empty($_POST['trueLogin'])||empty($_POST['truePass']))
{
    header("Location:login.php");
}
if (($_POST['trueLogin'] != "Toto") || ($_POST['truePass'] != "1234"))
{
    header("Location:login.php?uLogin=" . $_POST['trueLogin'] . "&qErr=Erreur de login");
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
       Bonjour <?= @$_POST['trueLogin'];?> ca va bro
        <br>
        <a href="login.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>

