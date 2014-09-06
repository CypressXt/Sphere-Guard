<?php

/*
 * 
 * Clément Hampaï
 * 
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiStatistics";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = displayUserStats($db, $userLogged);
    $tableRowResp = displayUserStatsResp($db, $userLogged);
    include_once ('view/ApiStatistics.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayUserStats($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayUserStatsTable($db, $userLogged);
}

function displayUserStatsResp($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayUserStatsTableRespon($db, $userLogged);
}
