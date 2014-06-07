<?php

/*
 * CypressXt
 */

session_start();
//------------------------------------------------------------------------------
//                         Includes & variables                            
//------------------------------------------------------------------------------

include_once "../model/MysqlConnect.php";
include_once '../model/User.php';
include_once '../model/UserManager.php';

//------------------------------------------------------------------------------
//                         AJAX PHP FUNCTIONS                            
//------------------------------------------------------------------------------

if ($_POST['function'] == "removeApiUser" && $_POST['user_pk'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userManager = new UserManager($db);
        $result = $userManager->removeApiUser($_POST['user_pk']);
        echo $result;
    } else {
        echo "You need to be logged first";
    }
}

if ($_POST['function'] == "refreshKey" && $_POST['user_pk'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userManager = new UserManager($db);
        $resultKey = $userManager->refreshKey($_POST['user_pk']);
        echo $resultKey;
    } else {
        echo "You need to be logged first";
    }
}