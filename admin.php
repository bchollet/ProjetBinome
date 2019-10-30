<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 10:06
 */

include 'ConnectDB.php';
if ($_SESSION['admin'] == false) {
    header("Location:index.php?qErrRegister=10");
}

$result = $blogitoDB->query("SELECT username FROM users ORDER BY username");

foreach ($result as $row) {
    echo '<a>' . $row['username'] . '</a>' . '<input type="button" value=" X "><br>';
}
?>

