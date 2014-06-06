<?php

/*
 * CypressXt
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiKeyManagement";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    $user = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = getUserAndKey($db, $user);
    include_once ('view/ApiKeyUser.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function getUserAndKey($db, $user) {
    $html = '<table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Key</th>
                <th>Action</th>
            </tr>';
    if (isset($_SESSION['SphereGuardLogged'])) {
        include_once 'model/ApiManager.php';
        $apiManager = new ApiManager($db);
        $apiArray = $apiManager->getAllApi();
        for ($i = 0; $i < count($apiArray); $i++) {
            $html = $html . '<tr>';
            $html = $html . '<td>' . ($i + 1) . '</td>';
            $html = $html . '<td>' . $apiArray[$i]['name'] . '</td>';
            $html = $html . '<td>' . $apiArray[$i]['mail'] . '</td>';
            $html = $html . '<td><input type="text" class="form-control" placeholder="api key" value="' . $apiArray[$i]['key'] . '" disabled></td>';
            $html = $html . '<td><button type="button" class="btn btn-primary btn-xs">refresh key</button> ';
            if ($apiArray[$i]['pk_api'] != $user['pk_api']) {
                $html = $html . '<button type="button" class="btn btn-danger btn-xs">remove</button>';
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
