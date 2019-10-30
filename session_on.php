<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 11:16
 */

session_start();
if(!isset($_SESSION['isLogged'])) {
    session_destroy();
    header("Location:login.php");
    exit();
}

?>