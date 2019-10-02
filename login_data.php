<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 11:52
 */

session_start();

if (empty($_POST['uLogin'])||empty($_POST['uPass']))
{
    header("Location:login.php");
}
if (($_POST['uLogin'] != "Toto") || ($_POST['uPass'] != "1234"))
{
    header("Location:login.php?uLogin=" . $_POST['uLogin'] . "&qErr=Erreur de login");
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
        <?= @$_POST['uLogin'];?>
    </p>
</body>