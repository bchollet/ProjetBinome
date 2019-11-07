<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 31.10.2019
 * Time: 14:45
 */

//Fermeture de la session et retour à la page login
session_start();
session_destroy();
header("location:login.php");
exit();

?>