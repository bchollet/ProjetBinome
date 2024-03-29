<?php
include 'ConnectDB.php';
include 'session_on.php';

$currentUser = $_SESSION['username']; //Récupération du username connecté

?>

<!DOCTYPE HTML>
<!--
	Snapshot by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
    <title>Blogito</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body>
<div class="page-wrap">

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="#"><span class="icon fa-home"></span></a></li>
            <li><a href="#" class="active"><span class="icon fa-camera-retro"></span></a></li>
            <li><a href="add_img.php"><span class="icon fas fa-plus"></span></a></li>
            <li><a href="logout.php"><span class="icon fas fa-sign-out"></span></a></li>
        </ul>
    </nav>

    <!-- Main -->
    <section id="main">

        <!-- Header -->
        <header id="header">
            <div>Blogito</div>
        </header>

        <!-- Gallery -->
        <section id="galleries">
            <!-- Photo Galleries -->
            <div class="gallery">
                <div class="content">
                    <?php

                    //Récupération des images (large et miniature) contenues dans le répertoire de l'utilisateur connecté
                    $result = $blogitoDB->query("SELECT users.username, publications.pictureSrc, publications.thumbSrc FROM users INNER JOIN publications on users.pages_id = publications.pages_id WHERE users.username ='" . $currentUser . "'");

                    foreach ($result as $row) {

                        $thumb = $row['thumbSrc'];
                        $picture = $row['pictureSrc'];
                        echo '<div class="media all people">';

                        //Sur la page s'affiche les miniature. Lorsqu'on clique sur une image, la version large s'affiche
                        echo '<a href="' . $picture . '"><img src="' . $thumb . '" alt="" title=""/></a>';
                        echo '</div>';

                    }
                    ?>
                </div>
            </div>
        </section>
    </section>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.poptrox.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>