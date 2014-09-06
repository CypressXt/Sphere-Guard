<?php

/*
 * 
 * Clément Hampaï
 * 
 */

if (!isset($_SESSION['SphereGuardLogged'])) {
    $_SESSION['askedSphereGuard'] = "apiKeyManagement";
    header('Location: /SphereGuard/index.php?l=login');
} else {
    include_once 'model/User.php';
    $userLogged = unserialize($_SESSION['SphereGuardLogged']);
    $tableRow = displayUserAndKey($db, $userLogged);
    $tableRowResp = displayUserAndKeyResp($db, $userLogged);
    $modalBody = displayNewHostFrom($db);
    $modalRightButtonText = "Create";
    $modalRightButtonOnclick = "requestAjaxCreateUser($('input[name=inputName]'), $('input[name=inputMail]'), $('input[name=inputPass]'), $('input[name=inputPassConf]'), $('#isAdministrator').is(':checked'))";
    $modalTitle = "New api user";
    include_once ('view/ApiKeyUser.php');
    $dashboardError = $_SESSION['SphereGuardError'];
    include_once 'view/ApiDashboard.php';
}

function displayUserAndKey($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayUserTable($db, $userLogged);
}

function displayUserAndKeyResp($db, $userLogged) {
    include_once 'model/HtmlDisplayer.php';
    return htmlDisplayer::displayUserTableRespon($db, $userLogged);
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
