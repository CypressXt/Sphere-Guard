<?php

/*
 * 
 * Clément Hampaï
 * 
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiHostsManagement";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/Host.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = displayUserAndKey($db, $userLogged);
    $tableRowResp = displayUserAndKeyResponsive($db, $userLogged);
    $modalBody = displayNewHostFrom($db);
    $modalRightButtonText = "Create";
    $modalRightButtonOnclick = "requestAjaxCreateHost($('input[name=inputName]'), $('input[name=inputIp]'))";
    $modalTitle = "New api user";
    include_once ('view/ApiHosts.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayUserAndKey($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayHostTable($db, $userLogged);
}

function displayUserAndKeyResponsive($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayHostTableRespon($db, $userLogged);
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
