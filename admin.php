<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 30.10.2019
 * Time: 10:06
 */

include 'ConnectDB.php';
include 'session_on.php';


if ($_SESSION['admin'] == false) {
    header("Location:login.php");
    exit();
}

$result = $blogitoDB->query("SELECT username FROM users WHERE admin = 0 ORDER BY username");
?>

<form method="post" action="delete_user.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">

    <?php
    foreach ($result as $row) {

        $username = $row['username'];
        echo '<a href="#">' . $username . '</a>' . '<button type="submit" name="userToDelete" value=' . $username . '> X </button><br>';
    }
    ?>

</form>



