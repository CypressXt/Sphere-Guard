<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'model/ApiManager.php';
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
        $apiManager = new ApiManager($db);
        $checkResult = $apiManager->checkLogin($userName, $password);
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
