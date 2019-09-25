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
            <form class="register-form">
                <input type="text" placeholder="name"/>
                <input type="password" placeholder="password"/>
                <input type="text" placeholder="email address"/>
                <button>create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form">
                <input type="text" placeholder="username"/>
                <input type="password" placeholder="password"/>
                <button>login</button>
                <p class="message">Vous n'êtes pas inscrit ? <a href="#">Créer un compte</a></p>
            </form>
        </div>
    </div>
<script type="text/javascript" src="./script/login.js"></script>
</body>
</html>

