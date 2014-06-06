<?php

/*
 * CypressXt
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "personalInfo";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    $userLogged = new User(unserialize($_SESSION['SphereGuardLogged']));
    $userName = $userLogged->getName();
    $userMail = $userLogged->getMail();
    include_once ('view/ApiPersonalInfo.php');
    checkUpdateInfo($db, $userLogged);
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function checkUpdateInfo($db, $userLogged) {
    if (isset($_SESSION['SphereGuardLogged'])) {
        if (isset($_POST['submitUpdate'])) {
            include_once 'model/UserManager.php';
            $userLogged = new User($userLogged);
            $newUserName = $_POST['inputName'];
            $newMail = $_POST['inputMail'];
            $newPassword = $_POST['inputPass'];
            $newPasswordConf = $_POST['inputPassConf'];
            $userManager = new UserManager($db);
            // check if the username is valid and don't exist 
            if ($newUserName == "") {
                $_SESSION['SphereGuardError'] = $_SESSION['errorForm'] . '<div class="alert alert-warning">Invalid name</div>';
                return false;
            }

            //check if the password is valid and is equals to the passwordCheck
            if ($newPassword == "" || $newPassword != $newPasswordConf) {
                $_SESSION['SphereGuardError'] = $_SESSION['errorForm'] . '<div class="alert alert-warning">Invalid password or password confirmation</div>';
                return false;
            }

            //check if the mail@ is valid and don't already exist
            if ($newMail == "" || $userManager->isMailTakenByOther($user, $newMail)) {
                $_SESSION['SphereGuardError'] = $_SESSION['errorForm'] . '<div class="alert alert-warning">Invalid @Mail or already taken</div>';
                return false;
            }

            $userLogged->setName($newUserName);
            $userLogged->setPassword(sha1($newPassword));
            $userLogged->setMail($newMail);
            $userManager->updateApi($user);
            $_SESSION['SphereGuardLogged'] = serialize($user);
            $_SESSION['SphereGuardError'] = "";
        }
    }
}
