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
            <!-- les attributs "name" des <input> sont précédés de "nu" pour "New Users" -->
            <form class="register-form" method="post" action="register_data.php">
                <input type="text" placeholder="Nom d'utilisateur" name="nuLogin" value=""/>
                <input type="password" placeholder="Mot de passe" name="nuPass" value=""/>
                <input type="password" placeholder="Confirmer mot de passe" name="nuConfPass" value=""/>
                <input type="text" placeholder="Adresse email" name="nuMail" value=""/>
                <button type="submit">créer</button>
                <p class="message">Déjà inscrit ? <a href="#">Se connecter</a></p>
            </form>
            <!-- les attributs "name" des <input> sont précédés de "u" pour "Users" -->
            <form class="login-form" method="post" action="login_data.php">
                <?php  if (isset($_GET['qErr']))
                {
                    echo('<p class="alert alert-danger">' . $_GET['qErr'] . '</p>');
                }
                ?>
                <input type="text" placeholder="Nom d'utilisateur" name="uLogin" value=""/>
                <input type="password" placeholder="Mot de passe" name="uPass" value=""/>
                <button type="submit">se connecter</button>
                <p class="message">Vous n'êtes pas inscrit ? <a href="#">Créer un compte</a></p>
            </form>
        </div>
    </div>
<script type="text/javascript" src="./script/login.js"></script>
</body>
</html>

