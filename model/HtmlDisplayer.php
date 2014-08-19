<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class htmlDisplayer {

    public static function displayHostTable($db, $userLogged) {
        $html = '<table id="hostsTable" class="table table-striped hidden-xs hidden-sm">
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
            $html = $html . '<button class="btn btn-primary btn-sm hidden-xs hidden-sm" data-toggle="modal" data-target="#modal">Add new host</button>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayHostTableRespon($db, $userLogged) {
        $html = '';
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            $hostManager = new HostManager($db);
            $hostArray = $hostManager->getAllHosts();
            for ($i = 0; $i < count($hostArray); $i++) {
                $currentHost = $hostArray[$i];
                $html .= '<div class="panel panel-default hidden-md hidden-lg" id="lineResp' . $currentHost->getPk_host() . '">
                            <div class="panel-body">
                              <div class="panelHead">' . $currentHost->getName() . '</div>
                              Unique ID: <span class="badge">' . $currentHost->getPk_host() . '</span></br>
                              Ip: ' . $currentHost->getIp() . '</br></br>
                              <button id="buttonRemoveResp' . $currentHost->getPk_host() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveHost(\'' . $currentHost->getPk_host() . '\')">Remove host</button>
                            </div>
                          </div>';
            }
            $html = $html . '<button class="btn btn-primary btn-sm hidden-md hidden-lg" data-toggle="modal" data-target="#modal">Add new host</button>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayUserTable($db, $userLogged) {
        $html = '<table id="usersTable" class="table table-striped hidden-xs hidden-sm">
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
            $html = $html . '<button class="btn btn-primary btn-sm hidden-xs hidden-sm" data-toggle="modal" data-target="#modal">Add new user & key</button>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayUserTableRespon($db, $userLogged) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/UserManager.php';
            $userManager = new UserManager($db);
            $apiArray = $userManager->getAllApi();
            for ($i = 0; $i < count($apiArray); $i++) {
                $currentUser = $apiArray[$i];
                $html .= '<div class="panel panel-default hidden-md hidden-lg" id="lineResp' . $currentUser->getPk_api() . '">
                        <div class="panel-body">
                          Name: <div class="panelHead">' . $currentUser->getName() . '</div>
                          <p>Email: ' . $currentUser->getMail() . '</p></br>
                          <div class="keyPar">Key: <span class="keyNum">' . $currentUser->getKey() . '</span></div>
                          ';
                if ($currentUser->getPk_api() != $userLogged->getPk_api()) {
                    $html .= '<button id="buttonRemoveResp' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')">remove</button>';
                } else {
                    $html .= '<button id="buttonRemoveResp' . $currentUser->getPk_api() . '" type="button" class="btn btn-danger btn-xs" onclick="requestAjaxRemoveUser(\'' . $currentUser->getPk_api() . '\')" disabled>remove</button>';
                }
                $html .= '</div>
                      </div>';
            }
            $html = $html . '<button class="btn btn-primary btn-sm hidden-md hidden-lg" data-toggle="modal" data-target="#modal">Add new user & key</button>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

}
