<?php

/*
 * CypressXt
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "personalInfo";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    $user = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $user['name'];
    $userMail = $user['mail'];
    include_once ('view/ApiPersonalInfo.php');
    checkUpdateInfo($db);
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function checkUpdateInfo($db) {
    if (isset($_SESSION['SphereGuardLogged'])) {
        if (isset($_POST['submitUpdate'])) {
            include_once 'model/ApiManager.php';
            $newUserName = $_POST['inputName'];
            $newMail = $_POST['inputMail'];
            $newPassword = $_POST['inputPass'];
            $newPasswordConf = $_POST['inputPassConf'];
            $user = unserialize($_SESSION['SphereGuardLogged']);
            $apiManager = new ApiManager($db);
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
            if ($newMail == "" || $apiManager->isMailTakenByOther($user, $newMail)) {
                $_SESSION['SphereGuardError'] = $_SESSION['errorForm'] . '<div class="alert alert-warning">Invalid @Mail or already taken</div>';
                return false;
            }

            $user['name'] = $newUserName;
            $user['password'] = sha1($newPassword);
            $user['mail'] = $newMail;
            $apiManager->updateApi($user);
            $_SESSION['SphereGuardLogged'] = serialize($user);
            $_SESSION['SphereGuardError'] = "";
        }
    }
}
