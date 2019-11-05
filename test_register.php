<?php
/**
 * Created by PhpStorm.
 * User: bastian.chollet
 * Date: 05.11.2019
 * Time: 08:56
 */

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
    $usersInDB = array("Marie", "Jean", "Marc");
    $username = "Pascal";
    $password = 'Pa$$w0rd';
    $email = 'test@gmail.com';
    $errExpected = 0;

    //Act
    $errCalculated = verifRegister($usersInDB, $username, $password, $email);

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
    $usersInDB = array("Marie", "Jean", "Marc");
    $username = "Marie";
    $password = 'Pa$$w0rd';
    $email = 'test@gmail.com';
    $errExpected = 1;

    //Act
    $errCalculated = verifRegister($usersInDB, $username, $password, $email);

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
    $usersInDB = array("Marie", "Jean", "Marc");
    $username = "Pascal";
    $password = 'Pa$$w0rd';
    $email = 'testgmail.com';
    $errExpected = 2;

    //Act
    $errCalculated = verifRegister($usersInDB, $username, $password, $email);

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
    $usersInDB = array("Marie", "Jean", "Marc");
    $username = "Pascal";
    $password = 'pa$$w0rd';
    $email = 'test@gmail.com';
    $errExpected = 12;

    //Act
    $errUppercase = verifRegister($usersInDB, $username, $password, $email);

    $password = 'PA$$W0RD';
    $errLowerCase = verifRegister($usersInDB, $username, $password, $email);

    $password = 'Pa$$word';
    $errNumber = verifRegister($usersInDB, $username, $password, $email);

    $password = 'Pa$$w0';
    $errSpecialChars = verifRegister($usersInDB, $username, $password, $email);

    //Assert
    if (($errUppercase + $errLowerCase + $errNumber + $errSpecialChars) == $errExpected){
        echo 'PasswordWeak => test réussi ! ';
    }
    else {
        echo 'PasswordWeak => test échoué ! ';
    }
}

?>