<?php
/**
 * Created by PhpStorm.
 * User: Milos.CEROVIC
 * Date: 02.10.2019
 * Time: 11:52
 */

//Connexion à la DB
include 'connectDB.php';

// On vérifie la force de mot de passe. Ici, le mdp doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial
$nuPass = $_POST['nuPass'];
$uppercase = preg_match('@[A-Z]@', $nuPass);
$lowercase = preg_match('@[a-z]@', $nuPass);
$number = preg_match('@[0-9]@', $nuPass);
$specialChars = preg_match('@[^\w]@', $nuPass);

//Vérification que le login soit bien disponible. Si la requête retourne une valeur, alors le login est déjà pris
$result = $myPDO->query("SELECT username FROM users WHERE username ='" . $_POST['nuLogin'] . "';");

foreach ($result as $row) {
    $loginTaken = $row['username'];
    if ($loginTaken == $_POST['nuLogin']) {
        echo '<script>console.log(' . $loginTaken . ')</script>';
        header("Location:index.php?qErrRegister=0");
    }
}

//Vérification que les champs soient tous remplis
if (empty($_POST['nuLogin']) || empty($_POST['nuPass']) || empty($_POST['nuMail']) || empty($_POST['nuConfPass'])) {
    header("Location:index.php?qErrRegister=1");
}

//Vérification que le mot de passe respectent les critères de sécurités + au minimum 8 caractères
elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($nuPass) < 8) {
    header("Location:index.php?qErrRegister=2");
}

//Vérification que les deux mots de passent entrés soient identiques
elseif ($_POST['nuPass'] != $_POST['nuConfPass']) {
    header("Location:index.php?qErrRegister=3");
}

//Vérification que l'adresse mail entrée ait un format valide (1 caractère avant et après le '@', la présence d'un '.' en deuxième partie ainsi qu'un caractère avant et après ce dernier
elseif (!filter_var($_POST['nuMail'], FILTER_VALIDATE_EMAIL)) {
    header("Location:index.php?qErrRegister=4");
}

//Si aucun conflit, on insère le nouvel utilisateur dans la base de donnée en encryptant le mot de passe et en lui attribuant un code d'activation
else {
    $passwordHashed = password_hash($_POST['nuPass'], PASSWORD_BCRYPT);
    $userActivationCode = md5(rand());
    $myPDO->query("INSERT INTO users (id, username, password, email, admin, verification_code) VALUES (null,'" . $_POST['nuLogin'] . "', '" . $passwordHashed . "', '" . $_POST['nuMail'] . "', 0, '" . $userActivationCode . "');");

//    $to = $_POST['nuMail'];
//    $subject = "Vérification de l'adresse mail";
//    $verifURL = "http://localhost:81/Blogito/verifMail.php?actCode=" . $userActivationCode;
//    $message = "
//    <p>Coucou fdp " . $_POST['nuLogin'] . " !</p>
//    <p>Pour confirmer votre inscription, veuillez cliquer sur ce lien: " . $verifURL . " </p>
//    ";
//
//    $headers[] = 'MIME-Version: 1.0';
//    $headers[] = 'Content-type: text/html; charset=iso-8859-1';


    //mail($to, $subject, $message, implode("\r\n", $headers));

//    $mail = new PHPMailer(true);
//
////Send mail using gmail
//    if($send_using_gmail){
//        $mail->IsSMTP(); // telling the class to use SMTP
//        $mail->SMTPAuth = true; // enable SMTP authentication
//        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
//        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
//        $mail->Port = 465; // set the SMTP port for the GMAIL server
//        $mail->Username = "your-gmail-account@gmail.com"; // GMAIL username
//        $mail->Password = "your-gmail-password"; // GMAIL password
//    }
//
////Typical mail data
//    $mail->AddAddress($email, $name);
//    $mail->SetFrom($email_from, $name_from);
//    $mail->Subject = "My Subject";
//    $mail->Body = "Mail contents";
//
//    try{
//        $mail->Send();
//        echo "Success!";
//    } catch(Exception $e){
//        //Something went bad
//        echo "Fail - " . $mail->ErrorInfo;
//    }


}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Blogito - Inscription</title>
    <script src="./jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <p>
       Bonjour <?= @$_POST['nuLogin'];?> vous allez recevoir un mail pour valider votre compte
        <br>
        <a href="index.php">
            <button>Retour menu</button>
        </a>
    </p>
</body>