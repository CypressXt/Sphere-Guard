<?php

/*
 * Clément Hampaï
 */

session_start();
//------------------------------------------------------------------------------
//                         Includes & variables                            
//------------------------------------------------------------------------------

include_once "../model/MysqlConnect.php";
include_once '../model/User.php';
include_once '../model/UserManager.php';
include_once '../model/Host.php';
include_once '../model/HostManager.php';
include_once '../model/HtmlDisplayer.php';
$userLogged = unserialize($_SESSION['SphereGuardLogged']);

//------------------------------------------------------------------------------
//                         AJAX PHP FUNCTIONS                            
//------------------------------------------------------------------------------

/**
 * This function is called by JS.
 * It remove the user selected by id.
 * {int} user_pk
 */
if ($_POST['function'] == "removeApiUser" && $_POST['user_pk'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userLogged = unserialize($_SESSION['SphereGuardLogged']);
        if ($_POST['user_pk'] != $userLogged->getPk_api()) {
            $userManager = new UserManager($db);
            $result = $userManager->removeApiUser($_POST['user_pk']);
            echo $result;
        }
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It create a new api key and assign it to the user selected by id.
 * {int} user_pk
 */
if ($_POST['function'] == "refreshKey" && $_POST['user_pk'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userManager = new UserManager($db);
        $resultKey = $userManager->refreshKey($_POST['user_pk']);
        echo $resultKey;
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It create a new user with all his attribute.
 * {String} name
 * {String} mail
 * {String} password
 * {String} passConf
 * {0/1} isAdministrator
 */
if ($_POST['function'] == "addUser" && $_POST['name'] != "" && $_POST['mail'] != "" && $_POST['password'] != "" && $_POST['passConf'] != "" && $_POST['isAdministrator'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $isAdmin = ($_POST['isAdministrator'] == "true") ? 1 : 0;
        if ($_POST['password'] == $_POST['passConf']) {
            $userManager = new UserManager($db);
            $userData = Array(
                'name' => $_POST['name'],
                'mail' => $_POST['mail'],
                'password' => $_POST['password'],
                'admin' => $isAdmin
            );
            $newUser = new User($userData);
            $result = $userManager->addApi($newUser);
            echo $result;
        } else {
            echo "password & password confirmation are different";
        }
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It refresh the user's table.
 */
if ($_POST['function'] == "refreshUserTable") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $html = htmlDisplayer::displayUserTable($db, $userLogged);
        $html .= htmlDisplayer::displayUserTableRespon($db, $userLogged);
        echo $html;
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It create a new host with all his attribute.
 * {String} name
 * {String} ipAddr
 */
if ($_POST['function'] == "addHost" && $_POST['name'] != "" && $_POST['ipAddr'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $hostManager = new HostManager($db);
        $hostData = Array(
            'name' => $_POST['name'],
            'ip' => $_POST['ipAddr']
        );
        $newHost = new Host($hostData);
        $result = $hostManager->addHost($newHost);
        echo $result;
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It refresh the table witch contain the host list.
 */
if ($_POST['function'] == "refreshHostTable") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $html = htmlDisplayer::displayHostTable($db, $userLogged);
        $html .= htmlDisplayer::displayHostTableRespon($db, $userLogged);
        echo $html;
    } else {
        echo "You need to be logged first";
    }
}

/**
 * This function is called by JS.
 * It remove an host given by id.
 * {int} hostId
 */
if ($_POST['function'] == "removeApiHost" && $_POST['hostId'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $hostManager = new HostManager($db);
        $result = $hostManager->removeHost($_POST['hostId']);
        echo $result;
    } else {
        echo "You need to be logged first";
    }
}