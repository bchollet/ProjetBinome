<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 31.10.2019
 * Time: 14:45
 */

session_start();
session_destroy();
header("location:login.php");
exit();

?>