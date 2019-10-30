<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 10:51
 */
include 'connectDB.php';
include 'session_on.php';

if ($_SESSION['admin'] == false) {
    header("Location:index.php");
    exit();
}

$username = @$_POST['userToDelete'];

$blogitoDB->query("DELETE FROM users WHERE username ='" . $username . "'");

header("Location:admin.php");
?>