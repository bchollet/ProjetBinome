<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 01.11.2019
 * Time: 09:04
 */
//Your Image

if (@$_REQUEST['action'] == "add") {

    $userfile = $_FILES['photo']['tmp_name'];
    $userfile_name = $_FILES['photo']['name'];
    $userfile_size = $_FILES['photo']['size'];
    $userfile_type = $_FILES['photo']['type'];

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
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
    imagejpeg($thumb, "server/img/thumb" . $userfile_name, 100);

    // Uploading normal-size image
    $large = imagecreatetruecolor($width, $height);
    imagecopyresampled($large, $myImage, 0, 0, 0, 0, $width, $height, $width, $height);
    imagejpeg($large, "server/img" . $userfile_name, 100);

}
?>

<html>
<head><title>create thumb</title></head>
<body>
<form name="form1" enctype="multipart/form-data" action="test_crop.php?action=add" method="post">
    Select Photo: <input type="file" name="photo">
    <input type="submit" name="submit" value="CREATE THUMB AND UPLOAD">
</form>
</body
</html>
