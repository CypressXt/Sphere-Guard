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
    include_once 'model/HtmlDisplayer.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $userName = $userLogged->getName();
    $userMail = $userLogged->getMail();
    $cpuUsageTable = displayCpuInfo($db);
    $cpuUsageTableRespon = displayCpuInfoRespon($db);
    $tmpTable = displayTmpInfo($db);
    $tmpTableRespon = displayTmpInfoRespon($db);
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
