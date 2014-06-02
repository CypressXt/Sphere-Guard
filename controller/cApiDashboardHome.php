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
    $user = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $user['name'];
    $userMail = $user['mail'];
    include_once 'view/ApiDashboardHome.php';
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}
