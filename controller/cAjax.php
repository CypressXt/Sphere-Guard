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
include_once '../model/Host.php';
include_once '../model/HostManager.php';


//------------------------------------------------------------------------------
//                         AJAX PHP FUNCTIONS                            
//------------------------------------------------------------------------------

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

if ($_POST['function'] == "refreshKey" && $_POST['user_pk'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userManager = new UserManager($db);
        $resultKey = $userManager->refreshKey($_POST['user_pk']);
        echo $resultKey;
    } else {
        echo "You need to be logged first";
    }
}

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

if ($_POST['function'] == "refreshUserTable") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $userLogged = unserialize($_SESSION['SphereGuardLogged']);
        $userManager = new UserManager($db);
        $apiArray = $userManager->getAllApi();
        $html = '<table id="usersTable" class="table table-striped">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Key</th>
                <th>Action</th>
            </tr>';
        for ($i = 0; $i < count($apiArray); $i++) {
            $currentUser = $apiArray[$i];
            $html = $html . '<tr id="line' . $currentUser->getPk_api() . '">';
            $html = $html . '<td>' . ($i + 1) . '</td>';
            $html = $html . '<td>' . $currentUser->getName() . '</td>';
            $html = $html . '<td>' . $currentUser->getMail() . '</td>';
            $html = $html . '<td><input id="key' . $currentUser->getPk_api() . '" type="text" class="form-control" placeholder="api key" value="' . $currentUser->getKey() . '" disabled></td>';
            $html = $html . '<td><button type="button" class="btn btn-primary btn-xs" onclick="requestAjaxRefreshKeyUser(\'' . $currentUser->getPk_api() . '\')">refresh key</button> ';
            if ($currentUser->getPk_api() != $userLogged->getPk_api()) {
                $html = $html . '<button id="buttonRemove' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')">remove</button>';
            } else {
                $html = $html . '<button id="buttonRemove' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')" disabled>remove</button>';
            }
            $html = $html . '</td>';
            $html = $html . '</tr>';
        }
        echo $html . '</table>';
    } else {
        echo "You need to be logged first";
    }
}

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

if ($_POST['function'] == "refreshHostTable") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $html = '<table id="hostsTable" class="table table-striped">
            <tr>
                <th>Unique ID</th>
                <th>Name</th>
                <th>IP</th>
                <th>Action</th>
            </tr>';
        $hostManager = new HostManager($db);
        $hostArray = $hostManager->getAllHosts();
        for ($i = 0; $i < count($hostArray); $i++) {
            $currentHost = $hostArray[$i];
            $html = $html . '<tr id="line' . $currentHost->getPk_host() . '">';
            $html = $html . '<td>' . $currentHost->getPk_host() . '</td>';
            $html = $html . '<td>' . $currentHost->getName() . '</td>';
            $html = $html . '<td>' . $currentHost->getIp() . '</td>';
            $html = $html . '<td><button id="buttonRemove' . $currentHost->getPk_host() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveHost(\'' . $currentHost->getPk_host() . '\')">Remove host</button> ';
            $html = $html . '</td>';
            $html = $html . '</tr>';
        }
        $html = $html . '</table>';
        echo $html;
    } else {
        echo "You need to be logged first";
    }
}


if ($_POST['function'] == "removeApiHost" && $_POST['hostId'] != "") {
    if (isset($_SESSION['SphereGuardLogged'])) {
        $hostManager = new HostManager($db);
        $result = $hostManager->removeHost($_POST['hostId']);
        echo $result;
    } else {
        echo "You need to be logged first";
    }
}