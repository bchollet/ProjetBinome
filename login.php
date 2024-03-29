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
                <?php
                if (isset($_GET['qErrRegister']))
                {
                    //On affiche un message d'erreur différent selon l'erreur rencontrée à l'inscriptions
                    switch ($_GET['qErrRegister']) {

                        case 0:
                            echo('<p>Au moins un des champs n\'a pas été rempli</p>');
                            break;

                        case 1:
                            echo('<p>L\'adresse email entrée n\'est pas valide</p>');
                            break;

                        case 2:
                            echo('<p>Le mot de passe doit contenir 8 caractères dont: une majuscule, une minuscule, un chiffre et un caractère spécial (!, ?, #, @, $, ...) </p>');
                            break;

                        case 4:
                            echo('<p>Ce login est déjà pris</p>');
                            break;

                        case 3:
                            echo('<p>Les mots de passe ne correspondent pas</p>');
                            break;

                        default:
                            echo('<p>Erreur non identifiée</p>');
                            break;
                    }
                }
                ?>
                <input type="text" placeholder="Nom d'utilisateur" name="nuLogin" value=""/>
                <input type="password" placeholder="Mot de passe" name="nuPass" value=""/>
                <input type="password" placeholder="Confirmer mot de passe" name="nuConfPass" value=""/>
                <input type="text" placeholder="Adresse email" name="nuMail" value=""/>
                <button type="submit">créer</button>
                <p class="message">Déjà inscrit ? <a href="#">Se connecter</a></p>
            </form>
            <!-- les attributs "name" des <input> sont précédés de "u" pour "Users" -->
            <form class="login-form" method="post" action="login_data.php">
                <?php
                //Un message d'erreur s'affiche dépendant de la variable récupérée dans l'URL
                if (isset($_GET['qErrLog']))
                {
                    $_GET['qErrLog'] = "Mot de passe ou login incorrect";

                    echo('<p class="alert alert-danger">' . $_GET['qErrLog'] . '</p>');
                }
                if (isset($_GET['qErrVerif']))
                {
                    $_GET['qErrVerif'] = "Votre adresse mail n'est pas vérifiée";

                    echo('<p class="alert alert-danger">' . $_GET['qErrVerif'] . '</p>');
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
    <?php
    if (isset($_GET['qErrRegister'])) {
        $redirectScript = "$('form').animate({height: 'toggle', opacity: 'toggle'}, 'slow');";
        echo ('<script>' . $redirectScript . '</script>');
    }
    ?>
</body>
</html>

