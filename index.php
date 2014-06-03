<?php

session_start();
include_once "model/MysqlConnect.php";

$l = isset($_GET['l']) ? $_GET['l'] : false;

// Get to controller
switch ($l) {
    case "api":
        include_once "controller/cApi.php";
        break;
    case "apiDashboard":
        include_once "controller/cApiDashboardHome.php";
        break;
    case "apiKeyManagement":
        include_once "controller/cApiKeyManagement.php";
        break;
    case "login":
        include_once "controller/cLogin.php";
        break;
    case "logout":
        include_once "controller/cLogout.php";
        break;
    case "personalInfo":
        include_once "controller/cApiPersonalInfo.php";
        break;
    case false:
        include_once "controller/cApiDashboardHome.php";
        break;
}