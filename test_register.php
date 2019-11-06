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


verifRegister_verifAllEntries_RegisterOK();
echo '<br>';
verifRegister_verifUsernameAvailable_UsernameUnavailable();
echo '<br>';
verifRegister_verifMailFormat_MailNotValid();
echo '<br>';
verifRegister_verifPasswordStrength_PasswordWeak();

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