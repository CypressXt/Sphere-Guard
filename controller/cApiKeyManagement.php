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
    $tableRow = displayUserAndKey($db, $userLogged);
    $modalBody = displayNewHostFrom($db);
    $modalRightButtonText = "Create";
    $modalRightButtonOnclick = "requestAjaxCreateUser($('input[name=inputName]'), $('input[name=inputMail]'), $('input[name=inputPass]'), $('input[name=inputPassConf]'), $('#isAdministrator').is(':checked'))";
    $modalTitle = "New api user";
    include_once ('view/ApiKeyUser.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayUserAndKey($db, $userLogged) {
    $html = '<table id="usersTable" class="table table-striped">
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
                $html = $html . '<button id="buttonRemove' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')">remove</button>';
            } else {
                $html = $html . '<button id="buttonRemove' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')" disabled>remove</button>';
            }
            $html = $html . '</td>';
            $html = $html . '</tr>';
        }
        $html = $html . '</table>';
        $html = $html . '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal">Add new user & key</button>';
        return $html;
    } else {
        $html = "";
        return $html;
    }
}

function displayNewHostFrom($db) {
    $html = '<form class="form-horizontal" id="newUserForm" role="form" method="POST">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input name="inputName" type="text" class="form-control"  id="inputName" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input name="inputMail" type="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input name="inputPass" type="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPasswordConf" class="col-sm-2 control-label">Password confirmation</label>
        <div class="col-sm-10">
            <input name="inputPassConf" type="password" class="form-control" id="inputPasswordConf" placeholder="Password confirmation">
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input id="isAdministrator" type="checkbox"> Api administrator
        </label>
      </div>
    </div>
  </div>
</form>';
    return $html;
}
