<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 01.11.2019
 * Time: 09:04
 */
//Your Image

include 'ConnectDB.php';
include 'session_on.php';

$currentUser = $_SESSION['username'];

if (@$_REQUEST['action'] == "add") {

    //Récupération des données relatives à l'image
    $userfile = $_FILES['photo']['tmp_name'];
    $userfile_name = $_FILES['photo']['name'];
    $userfile_size = $_FILES['photo']['size'];
    $userfile_type = $_FILES['photo']['type'];
    $time = date('dFYhisA'); //Récupération de la date au format "01 january 2019 12 00 30 PM" sans les espaces

    //Récupération des dimensions de l'image
    list($width, $height) = getimagesize($userfile);

    //Enregistrement de l'image dans la mémoire
    $myImage = imagecreatefromjpeg($userfile);

    //On analyse les dimensions de l'image pour créer la miniature
    if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2;
        $smallestSide = $height;
    } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
    }

    //Création de la miniature et enregistrement de celle-ci dans le répertoire de l'utilisateur
    $thumbSize = 450;
    $thumbPath = "server/img/" . $currentUser . "/thumb/thumb" . $time . $userfile_name;
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
    imagejpeg($thumb, $thumbPath, 100);

    //Upload de l'image large et enregistrement de celle-ci dans le répertoire de l'utilisateur
    $largePath = "server/img/" . $currentUser . "/large/img" . $time . $userfile_name;
    $large = imagecreatetruecolor($width, $height);
    imagecopyresampled($large, $myImage, 0, 0, 0, 0, $width, $height, $width, $height);
    imagejpeg($large, $largePath, 100);

    //On insère le chemin d'accès de l'image et de sa miniature dans la base de donnée
    $result = $blogitoDB->query("SELECT pages_id FROM users WHERE username = '" . $currentUser . "'");
    $row = $result->fetch();
    $page_id = $row['pages_id'];

    $blogitoDB->query("INSERT INTO publications VALUES (null, '" . $largePath. "'," . $page_id . " , '" . $thumbPath ."')");

}
?>

<html>
<head><title>create thumb</title></head>
<body>
<form name="form1" enctype="multipart/form-data" action="add_img.php?action=add" method="post">
    Select Photo: <input type="file" name="photo">
    <input type="submit" name="submit" value="CREATE THUMB AND UPLOAD">
</form>
<?php echo "<a href='index.php?user=" . $currentUser  . "'>" ?>
    <button>Retour menu</button>
</a>
</body
</html>
