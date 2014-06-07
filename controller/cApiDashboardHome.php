<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiDashboard";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $userLogged->getName();
    $userMail = $userLogged->getMail();
    include_once 'view/ApiDashboardHome.php';
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}
