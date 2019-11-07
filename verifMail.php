<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 10:19
 */

include 'ConnectDB.php';

$activationCode = $_GET['code']; //Récupération du code dans l'URL

//On va chercher dans la DB l'utilisateur auquel le code d'activation correspond
$result = $blogitoDB->query("SELECT username FROM users WHERE verification_code = '" . $activationCode . "';");
$row = $result->fetch();

//Si une entrée est obtenue dans la DB, on crée une nouvelle page qu'on associe à l'utilisateur fraichement identifié
if (!empty($row)) {
    $blogitoDB->query("INSERT INTO pages VALUES (null, 'default')");
    $lastInsertId = $blogitoDB->lastInsertId();
    $blogitoDB->query("UPDATE users SET user_verified = 1, pages_id = " . $lastInsertId . " WHERE verification_code = '" . $activationCode . "';");

    //Création d'un répertoire au nom de l'utilisateur sur le serveur contenant les futures images uploadées
    mkdir("server/img/" . $row['username']);
    mkdir("server/img/" . $row['username'] . "/large");
    mkdir("server/img/" . $row['username'] . "/thumb");
}

else {
    header("Location:login.php?qErrRegister=10");
    exit();
}

echo 'Votre compte a été validé ! Vous pouvez désormais vous connecter en utilisant vos identifiants';

?>

<a href="login.php">
    <button>Retour menu</button>
</a>
