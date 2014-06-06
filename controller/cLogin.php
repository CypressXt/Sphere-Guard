<?php

/*
 * CypressXt
 */

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
        $checkResult = $userManager->checkLogin($userName, $password);
        if ($checkResult != null) {
            $_SESSION['SphereGuardLogged'] = serialize($checkResult);
            if (!isset($_SESSION['askedSphereGuard'])) {
                header('Location: /SphereGuard/index.php?l=apiDashboard');
            } else {
                header('Location: /SphereGuard/index.php?l=' . $_SESSION['askedSphereGuard']);
            }
        } else {
            $_SESSION['SphereGuardError'] = '<div class="alert alert-warning">Wrong login or password</div>';
            header('Location: /SphereGuard/index.php?l=login');
        }
    }
}
