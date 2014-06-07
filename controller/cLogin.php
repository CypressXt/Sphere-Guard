<?php

/*
 * CypressXt
 */

include_once 'model/User.php';
include_once 'model/UserManager.php';
$dashboardContent = file_get_contents('view/Login.php');
$dashboardError = $_SESSION['SphereGuardError'];
include_once 'view/ApiDashboard.php';
$_SESSION['SphereGuardError'] = "";
checkLogin($db);

function checkLogin($db) {
    if (isset($_POST['submitLogin'])) {
        $userName = $_POST['inputUsername'];
        $password = $_POST['inputPassword'];
        $password = sha1($password);
        $userManager = new UserManager($db);
        $userLogged = $userManager->checkLogin($userName, $password);
        if ($userLogged != null && $userLogged->getAdmin() == 1) {
            $_SESSION['SphereGuardLogged'] = serialize($userLogged);
            if (!isset($_SESSION['askedSphereGuard'])) {
                header('Location: /SphereGuard/index.php?l=apiDashboard');
            } else {
                header('Location: /SphereGuard/index.php?l=' . $_SESSION['askedSphereGuard']);
            }
        } else {
            if ($userLogged->getAdmin() != 1) {
                $_SESSION['SphereGuardError'] = '<div class="alert alert-warning">You\'ve no rights here</div>';
            } else {
                $_SESSION['SphereGuardError'] = '<div class="alert alert-warning">Wrong login or password</div>';
            }
            header('Location: /SphereGuard/index.php?l=login');
        }
    }
}
