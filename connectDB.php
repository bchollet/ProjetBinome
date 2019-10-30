<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 02.10.2019
 * Time: 10:29
 */


    //On utilise PHP Data Object (PDO) pour gérer la base de donnée SQLite
    $blogitoDB = new PDO('sqlite:server/BlogitoDB.db');
    session_start();

?>