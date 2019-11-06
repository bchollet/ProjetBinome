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

    $userfile = $_FILES['photo']['tmp_name'];
    $userfile_name = $_FILES['photo']['name'];
    $userfile_size = $_FILES['photo']['size'];
    $userfile_type = $_FILES['photo']['type'];
    $time = date('dFYhisA');

//getting the image dimensions
    list($width, $height) = getimagesize($userfile);

//saving the image into memory (for manipulation with GD Library)
    $myImage = imagecreatefromjpeg($userfile);

// calculating the part of the image to use for thumbnail
    if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2;
        $smallestSide = $height;
    } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
    }

    // copying the part into thumbnail
    $thumbSize = 450;
    $thumbPath = "server/img/" . $currentUser . "/thumb/thumb" . $time . $userfile_name;
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
    imagejpeg($thumb, $thumbPath, 100);

    // Uploading normal-size image
    $largePath = "server/img/" . $currentUser . "/large/img" . $time . $userfile_name;
    $large = imagecreatetruecolor($width, $height);
    imagecopyresampled($large, $myImage, 0, 0, 0, 0, $width, $height, $width, $height);
    imagejpeg($large, $largePath, 100);

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
