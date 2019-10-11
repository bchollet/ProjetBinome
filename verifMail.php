<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 10:19
 */

include 'ConnectDB.php';

$activationCode = $_GET['code'];

$blogitoDB->query("UPDATE users SET user_verified = 1 WHERE verification_code = '" . $activationCode . "';");

echo 'Votre compte a été validé ! Vous pouvez désormais vous connecter en utilisant vos identifiants';

?>

<a href="index.php">
    <button>Retour menu</button>
</a>
