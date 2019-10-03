<!--
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 25.09.2019
 * Time: 11:24
 -->


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Blogito - Login</title>
    <script src="./jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="login-page">
        <div class="form">

            <!-- Creation of the post method in the form -->
            <form class="register-form" method="post" action="login_data_newUser.php">
                <input type="text" placeholder="Nom d'utilisateur" name="uLogin" value="<?php echo @$_GET['uLogin']; ?>"/>
                <input type="password" placeholder="Mot de passe" name="uPass" value="<?php echo @$_GET['uPass']; ?>"/>
                <input type="password" placeholder="Confirmer mot de passe" name="uConfPass" value="<?php echo @$_GET['uConfPass']; ?>"/>
                <input type="text" placeholder="Adresse email" name="uMail" value="<?php echo @$_GET['uMail']; ?>"/>
                <button type="submit">créer</button>
                <p class="message">Déjà inscrit ? <a href="#">Se connecter</a></p>
            </form>
            <form class="login-form" method="post" action="login_data_connection.php">
                <?php  if (isset($_GET['qErr']))
                {
                    echo('<p class="alert alert-danger">' . $_GET['qErr'] . '</p>');
                }
                ?>
                <input type="text" placeholder="Nom d'utilisateur" name="trueLogin" value="<?php echo @$_GET['trueLogin']; ?>"/>
                <input type="password" placeholder="Mot de passe" name="truePass" value="<?php echo @$_GET['truePass']; ?>"/>
                <button type="submit">se connecter</button>
                <p class="message">Vous n'êtes pas inscrit ? <a href="#">Créer un compte</a></p>
            </form>
        </div>
    </div>
<script type="text/javascript" src="./script/login.js"></script>
</body>
</html>
<?php



?>

