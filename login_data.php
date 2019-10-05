<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 03.10.2019
 * Time: 14:11
 */

include 'ConnectDB.php';
$result = $myPDO->query("SELECT username FROM users where username = '" . $_POST['trueLogin'] . "'");



if (empty($_POST['trueLogin']) || empty($_POST['truePass']))
{
    header("Location:index.php");
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
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>

