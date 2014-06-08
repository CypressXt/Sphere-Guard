<?php

/*
 * CypressXt
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiHostsManagement";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/Host.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = displayUserAndKey($db, $userLogged);
    $modalBody = displayNewHostFrom($db);
    $modalRightButtonText = "Create";
    $modalRightButtonOnclick = "requestAjaxCreateHost($('input[name=inputName]'), $('input[name=inputIp]'))";
    $modalTitle = "New api user";
    include_once ('view/ApiHosts.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayUserAndKey($db, $userLogged) {
    $html = '<table id="hostsTable" class="table table-striped">
            <tr>
                <th>Unique ID</th>
                <th>Name</th>
                <th>IP</th>
                <th>Action</th>
            </tr>';
    if (isset($_SESSION['SphereGuardLogged'])) {
        include_once 'model/HostManager.php';
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
        $html = $html . '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal">Add new host</button>';
        return $html;
    } else {
        $html = "";
        return $html;
    }
}

function displayNewHostFrom($db) {
    $html = '<form class="form-horizontal" id="newHostForm" role="form" method="POST">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Hostname</label>
        <div class="col-sm-10">
            <input name="inputName" type="text" class="form-control"  id="inputName" placeholder="Hostname">
        </div>
    </div>
    <div class="form-group">
        <label for="inputIp" class="col-sm-2 control-label">Ip address</label>
        <div class="col-sm-10">
            <input name="inputIp" type="text" class="form-control" id="inputIp" placeholder="Ip address">
        </div>
    </div>
</form>';
    return $html;
}
