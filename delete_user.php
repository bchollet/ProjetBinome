<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 10:51
 */
include 'connectDB.php';
include 'session_on.php';

//Les utilisateurs non-admin sont redirigés vers une autre page
if ($_SESSION['admin'] == false) {
    header("Location:login.php");
    exit();
}

//On supprime l'utilisateur qui a été sélectionné
$username = @$_POST['userToDelete'];

$blogitoDB->query("DELETE FROM users WHERE username ='" . $username . "'");

header("Location:admin.php");

?>