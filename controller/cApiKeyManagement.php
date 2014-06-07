<?php

/*
 * CypressXt
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiKeyManagement";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = DisplayUserAndKey($db, $userLogged);
    include_once ('view/ApiKeyUser.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function DisplayUserAndKey($db, $userLogged) {
    $html = '<table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Key</th>
                <th>Action</th>
            </tr>';
    if (isset($_SESSION['SphereGuardLogged'])) {
        include_once 'model/UserManager.php';
        $userManager = new UserManager($db);
        $apiArray = $userManager->getAllApi();
        for ($i = 0; $i < count($apiArray); $i++) {
            $currentUser = $apiArray[$i];
            $html = $html . '<tr id="line' . $currentUser->getPk_api() . '">';
            $html = $html . '<td>' . ($i + 1) . '</td>';
            $html = $html . '<td>' . $currentUser->getName() . '</td>';
            $html = $html . '<td>' . $currentUser->getMail() . '</td>';
            $html = $html . '<td><input id="key' . $currentUser->getPk_api() . '" type="text" class="form-control" placeholder="api key" value="' . $currentUser->getKey() . '" disabled></td>';
            $html = $html . '<td><button type="button" class="btn btn-primary btn-xs" onclick="requestAjaxRefreshKeyUser(\'' . $currentUser->getPk_api() . '\')">refresh key</button> ';
            if ($currentUser->getPk_api() != $userLogged->getPk_api()) {
                $html = $html . '<button type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')">remove</button>';
            }
            $html = $html . '</td>';
            $html = $html . '</tr>';
        }
        $html = $html . '</table>';
        $html = $html . '<button type="button" class="btn btn-primary btn-sm">Add new user & key</button>';
        return $html;
    } else {
        $html = "";
        return $html;
    }
}
