<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "personalInfo";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    $user = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $user['name'];
    $userMail = $user['mail'];
    include_once ('view/ApiPersonalInfo.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function checkUpdateInfo() {
    if (isset($_SESSION['SphereGuardLogged'])) {
        if (isset($_POST['submitUpdate'])) {
            $newUserName = $_POST['inputName'];
            $newMail = $_POST['inputMail'];
            $newPassword = $_POST['inputPass'];
            $newPasswordConf = $_POST['inputPassConf'];
            $userManager = new UserManager($db);
            $user = new User(array());
            $user = unserialize($_SESSION['loggedUserObjectDuoQ']);

            // check if the username is valid and don't exist 
            if ($newUserName != "" && !$userManager->isUserNameTaken($newMail)) {
                
            } else {
                $_SESSION['errorForm'] = $_SESSION['errorForm'] . "</br>Invalid username";
                return false;
            }

            //check if the password is valid and is equals to the passwordCheck
            if ($newPassword != "" && $newPassword == $newPasswordConf) {
                
            } else {
                $_SESSION['errorForm'] = $_SESSION['errorForm'] . "</br>Invalid password or password confirmation";
                return false;
            }

            //check if the mail@ is valid and don't already exist
            if ($newMail != "" && !$userManager->isMailTakenByOther($user, $newMail)) {
                
            } else {
                $_SESSION['errorForm'] = $_SESSION['errorForm'] . "</br>Invalid @Mail or already taken";
                return false;
            }
            $user->setName($newUserName);
            $user->setMail($newMail);
            $user->setPassword(sha1($newPassword));
            $userManager->updateUserInfo($user);
            $_SESSION['loggedUserObjectDuoQ'] = serialize($user);
        }
    }
}
