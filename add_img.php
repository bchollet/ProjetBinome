<?php
if (@$_REQUEST['action'] == "add") {

    $userfile = $_FILES['photo']['tmp_name'];
    $userfile_name = $_FILES['photo']['name'];
    $userfile_size = $_FILES['photo']['size'];
    $userfile_type = $_FILES['photo']['type'];
    $error = 0;

/////////////////////////
//GET-DECLARE DIMENSIONS //

    $dimension = getimagesize($userfile);
    $large_width = $dimension[0]; // GET PHOTO WIDTH
    $large_height = $dimension[1]; //GET PHOTO HEIGHT
    $small_width = 120; // DECLARE THUMB WIDTH
    $small_height = 90; // DECLARE THUMB HEIGHT

/////////////////////////
//CHECK SIZE  //

    if ($userfile_size > 102400) {
        $error = 1;
        $msg = "The photo is over 100kb. Please try again.";
    }


////////////////////////////////
// CHECK TYPE (IE AND OTHERS) //

//    if ($userfile_type = "image/pjpeg") {
        if ($userfile_type != "image/jpeg") {
            $error = 1;
            $msg = "The photo must be JPG";
        }
//    }

//////////////////////////////
//CHECK WIDTH/HEIGHT //
    if ($large_width >= 6000 or $large_height >= 4000) {
        $error = 1;
        $msg = "The photo must be 600x400 pixels";
    }

///////////////////////////////////////////
//CREATE THUMB / UPLOAD THUMB AND PHOTO ///

    if ($error != 1) {

        $image = $userfile_name; //if you want to insert it to the database
        $pic = imagecreatefromjpeg($userfile);
        $small = imagecreatetruecolor($small_width, $small_height);
        imagecopyresampled($small, $pic, 0, 0, 0, 0, $small_width, $small_height, $large_width, $large_height);
        if (imagejpeg($small, "server/img/thumb" . $userfile_name, 100)) {
            $large = imagecreatetruecolor($large_width, $large_height);
            imagecopyresampled($large, $pic, 0, 0, 0, 0, $large_width, $large_height, $large_width, $large_height);
            if (imagejpeg($large, "server/img" . $userfile_name, 100)) {
            } else {
                $msg = "A problem has occured. Please try again.";
                $error = 1;
            }
        } else {
            $msg = "A problem has occured. Please try again.";
            $error = 1;
        }
    }
//////////////////////////////////////////////

/// If everything went right a photo (600x400) and
/// a thumb(120x90) were uploaded to the given folders
}
?>

<html>
<head><title>create thumb</title></head>
<body>
<form name="form1" enctype="multipart/form-data" action="add_img.php?action=add" method="post">
    Select Photo: <input type="file" name="photo">
    <input type="submit" name="submit" value="CREATE THUMB AND UPLOAD">
</form>
</body
</html>