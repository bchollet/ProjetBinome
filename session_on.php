<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 11:16
 */

//Démarre la session
session_start();

//Destruction de la session et retour à la page login si aucun utilisateur n'est connecté.
if(!isset($_SESSION['isLogged'])) {
    session_destroy();
    header("Location:login.php");
    exit();
}

?>