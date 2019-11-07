<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 05.11.2019
 * Time: 08:56
 */

//Valeurs par défaut utilisées pour les test
$defaultUsersInDB = array("Marie", "Jean", "Marc");
$defaultUsername = "Pascal";
$defaultPassword = 'Pa$$w0rd';
$defaultEmail = "test@gmail.com";

//Appel des tests et de leur résultat (réussi ou non)
verifRegister_verifAllEntries_RegisterOK();
echo '<br>';
verifRegister_verifUsernameAvailable_UsernameUnavailable();
echo '<br>';
verifRegister_verifMailFormat_MailNotValid();
echo '<br>';
verifRegister_verifPasswordStrength_PasswordWeak();

//Cette fonction vérifie les informations entrées par l'utilisateurs lors de son inscription
//Elle vérifie que le nom d'utilisateur soit disponible, que le mot de passe respecte des règles de sécurité et que l'adresse mail ait un format valide
//  param $userInDB: Tableau contenant plusieurs username fictifs
//  param $username: Nom d'utilisateur entré
//  param $$password: Mot de passe entré
//  param $$email: email entré
//  return: un entier correspondant au type d'erreur rencontré. 0 = pas d'erreur
function verifRegister($usersInDB, $username, $password, $email){

    $err = 0;

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    for ($i = 0; $i < 3; $i++) {

        echo'<script>console.log("' . $usersInDB[$i] . '")</script>';
        if ($username == $usersInDB[$i]){
            $err = 1;
            return $err;
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 2;
        return $err;
    }

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $err = 3;
        return $err;
    }

    return $err;
}

//Test de la fonction verifRegister
//Vérifie qu'aucune erreur n'est rencontrée lorsque toutes les entrées sont valides
function verifRegister_verifAllEntries_RegisterOK(){

    //Arrange
    global $defaultUsersInDB, $defaultUsername, $defaultPassword, $defaultEmail;
    $errExpected = 0;

    //Act
    $errCalculated = verifRegister($defaultUsersInDB, $defaultUsername , $defaultPassword, $defaultEmail);

    //Assert
    if ($errCalculated == $errExpected){
        echo 'RegisterOK => test réussi ! ';
    }

    else {
        echo 'RegisterOK => test échoué ! ';
    }
}

//Test de la fonction verifRegister
//Vérifie que la bonne erreur est rencontrée lorsque le nom d'utilisateur entré existe déjà dans le tableau
function verifRegister_verifUsernameAvailable_UsernameUnavailable(){

    //Arrange
    global $defaultUsersInDB, $defaultPassword, $defaultEmail;
    $username = "Marie";
    $errExpected = 1;

    //Act
    $errCalculated = verifRegister($defaultUsersInDB, $username, $defaultPassword, $defaultEmail);

    //Assert
    if ($errCalculated == $errExpected){
        echo 'UsernameUnavailable => test réussi ! ';
    }

    else {
        echo 'UsernameUnavailable => test échoué ! ';
    }
}

//Test de la fonction verifRegister
//Vérifie que la bonne erreur est rencontrée lorsque le mail entré n'a pas un format valide
function verifRegister_verifMailFormat_MailNotValid(){

    //Arrange
    global $defaultUsersInDB, $defaultUsername, $defaultPassword;
    $email = 'testgmail.com';
    $errExpected = 2;

    //Act
    $errCalculated = verifRegister($defaultUsersInDB, $defaultUsername, $defaultPassword, $email);

    //Assert
    if ($errCalculated == $errExpected){
        echo 'MailNotValid => test réussi ! ';
    }
    else {
        echo 'MailNotValid => test échoué ! ';
    }
}

//Test de la fonction verifRegister
//Vérifie que la bonne erreur est rencontrée lorsque le mot de passe ne respecte pas les règles de sécurité établies
//Toutes les règles de sécurité sont testées (1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial, 8 caractère minimum)
function verifRegister_verifPasswordStrength_PasswordWeak(){

    //Arrange
    global $defaultUsersInDB, $defaultUsername, $defaultEmail;
    $password = 'pa$$w0rd';
    $errExpected = 12;

    //Act
    $errUppercase = verifRegister($defaultUsersInDB, $defaultUsername, $password, $defaultEmail);

    $password = 'PA$$W0RD';
    $errLowerCase = verifRegister($defaultUsersInDB, $defaultUsername, $password, $defaultEmail);

    $password = 'Pa$$word';
    $errNumber = verifRegister($defaultUsersInDB, $defaultUsername, $password, $defaultEmail);

    $password = 'Pa$$w0';
    $errSpecialChars = verifRegister($defaultUsersInDB, $defaultUsername, $password, $defaultEmail);

    //Assert
    if (($errUppercase + $errLowerCase + $errNumber + $errSpecialChars) == $errExpected){
        echo 'PasswordWeak => test réussi ! ';
    }
    else {
        echo 'PasswordWeak => test échoué ! ';
    }
}

?>