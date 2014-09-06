<?php

/*
 * 
 * Clément Hampaï
 * 
 */


if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiDashboard";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    include_once 'model/HtmlDisplayer.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $userLogged->getName();
    $userMail = $userLogged->getMail();
    $cpuUsageTable = displayCpuInfo($db);
    $cpuUsageTableRespon = displayCpuInfoRespon($db);
    $tmpTable = displayTmpInfo($db);
    $tmpTableRespon = displayTmpInfoRespon($db);
    $activeUserTable = displayActiveUserTable($db);
    $activeUserTableRespon = displayActiveUserTableRespon($db);
    include_once 'view/ApiDashboardHome.php';
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayCpuInfo($db) {
    return htmlDisplayer::displayCpuUsageTable($db);
}

function displayCpuInfoRespon($db) {
    return htmlDisplayer::displayCpuUsageTableRespon($db);
}

function displayTmpInfo($db) {
    return htmlDisplayer::displayTmpTable($db);
}

function displayTmpInfoRespon($db) {
    return htmlDisplayer::displayTmpTableRespon($db);
}

function displayActiveUserTable($db) {
    return htmlDisplayer::displayActiveUserTable($db);
}

function displayActiveUserTableRespon($db) {
    return htmlDisplayer::displayActiveUsertableRespon($db);
}
