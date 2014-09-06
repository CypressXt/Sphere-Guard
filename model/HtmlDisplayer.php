<?php

/*
 * 
 * Clément Hampaï
 * 
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
                $html = $html . '<td><input id="key' . $currentUser->getPk_api() . '" type="text" class="form-control" placeholder="api key" value="' . $currentUser->getApikey() . '" disabled></td>';
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
                          <div class="keyPar">Key: <span class="keyNum">' . $currentUser->getApikey() . '</span></div>
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

    public static function displayUserStatsTable($db, $userLogged) {
        $html = '<table id="usersTable" class="table table-striped hidden-xs hidden-sm">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Number of api requests</th>
            </tr>';
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/UserManager.php';
            $userManager = new UserManager($db);
            $apiArray = $userManager->getAllApiStats();
            for ($i = 0; $i < count($apiArray); $i++) {
                $currentUser = $apiArray[$i];
                $html = $html . '<tr id="line' . $currentUser->getPk_api() . '">';
                $html = $html . '<td>' . ($i + 1) . '</td>';
                $html = $html . '<td>' . $currentUser->getName() . '</td>';
                $html = $html . '<td><span class="label label-default">' . $currentUser->getNbCall() . '</span></td>';
                $html = $html . '</tr>';
            }
            $html = $html . '</table>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayUserStatsTableRespon($db, $userLogged) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/UserManager.php';
            $userManager = new UserManager($db);
            $apiArray = $userManager->getAllApiStats();
            for ($i = 0; $i < count($apiArray); $i++) {
                $currentUser = $apiArray[$i];
                $html .= '<div class="panel panel-default hidden-md hidden-lg" id="lineResp' . $currentUser->getPk_api() . '">
                        <div class="panel-body">
                          Name: <div class="panelHead">' . $currentUser->getName() . '</div>
                          <p>Number of api requests: <span class="label label-default">' . $currentUser->getNbCall() . '</span></p></br>
                          ';
                $html .= '</div>
                      </div>';
            }
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayCpuUsageTable($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $html = '<table class="table table-striped hidden-xs hidden-sm">
            <tr>
                <th>#</th>
                <th>Hostname</th>
                <th>CPU usage</th>
                <th>Date</th>
            </tr>';
            $cpuUsageByHost = $hostManager->getCpuOverview();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $hostObj = new Host(array());
                $hostObj = $hostManager->getHostById($currentInfo['fk_host']);
                $html = $html . '<tr>';
                $html = $html . '<td>' . ($i + 1) . '</td>';
                $html = $html . '<td>' . $hostObj->getName() . '</td>';
                if ($currentInfo['value'] < 50) {
                    $html = $html . '<td><span class="label label-default">' . $currentInfo['value'] . ' % </span></td>';
                } else if ($currentInfo['value'] < 80) {
                    $html = $html . '<td><span class="label label-warning">' . $currentInfo['value'] . ' % </span></td>';
                } else {
                    $html = $html . '<td><span class="label label-danger">' . $currentInfo['value'] . ' % </span></td>';
                }
                $html = $html . '<td>' . date_format(new DateTime($currentInfo['date']), "d M H:i") . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayCpuUsageTableRespon($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $cpuUsageByHost = $hostManager->getCpuOverview();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $hostObj = new Host(array());
                $hostObj = $hostManager->getHostById($currentInfo['fk_host']);
                $html .= '<div class="panel panel-default hidden-md hidden-lg">
                        <div class="panel-body">
                            <div class="panelHead">' . $hostObj->getName() . '</div>';
                if ($currentInfo['value'] < 50) {
                    $html.='<p>CPU usage: <span class="label label-default">' . $currentInfo['value'] . ' %</span></p></br>';
                } else if ($currentInfo['value'] < 80) {
                    $html.='<p>CPU usage: <span class="label label-warning">' . $currentInfo['value'] . ' %</span></p></br>';
                } else {
                    $html.='<p>CPU usage: <span class="label label-danger">' . $currentInfo['value'] . ' %</span></p></br>';
                }
                $html.='<p>' . date_format(new DateTime($currentInfo['date']), "d M H:i") . '</p>';
                $html .= '</div>
                      </div>';
            }
            $html .='<p>Last cpu usage activity order by host</p>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayTmpTable($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $html = '<table class="table table-striped hidden-xs hidden-sm">
            <tr>
                <th>#</th>
                <th>Hostname</th>
                <th>Temp</th>
                <th>Date</th>
            </tr>';
            $cpuUsageByHost = $hostManager->getTmpOverview();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $hostObj = new Host(array());
                $hostObj = $hostManager->getHostById($currentInfo['fk_host']);
                $html = $html . '<tr>';
                $html = $html . '<td>' . ($i + 1) . '</td>';
                $html = $html . '<td>' . $hostObj->getName() . '</td>';
                if ($currentInfo['value'] < 50) {
                    $html = $html . '<td><span class="label label-default">' . $currentInfo['value'] . ' °C </span></td>';
                } else if ($currentInfo['value'] < 80) {
                    $html = $html . '<td><span class="label label-warning">' . $currentInfo['value'] . ' °C </span></td>';
                } else {
                    $html = $html . '<td><span class="label label-danger">' . $currentInfo['value'] . ' °C </span></td>';
                }
                $html = $html . '<td>' . date_format(new DateTime($currentInfo['date']), "d M H:i") . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayTmpTableRespon($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $cpuUsageByHost = $hostManager->getTmpOverview();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $hostObj = new Host(array());
                $hostObj = $hostManager->getHostById($currentInfo['fk_host']);
                $html .= '<div class="panel panel-default hidden-md hidden-lg">
                        <div class="panel-body">
                            <div class="panelHead">' . $hostObj->getName() . '</div>';
                if ($currentInfo['value'] < 50) {
                    $html.='<p>CPU usage: <span class="label label-default">' . $currentInfo['value'] . ' °C</span></p></br>';
                } else if ($currentInfo['value'] < 80) {
                    $html.='<p>CPU usage: <span class="label label-warning">' . $currentInfo['value'] . ' °C</span></p></br>';
                } else {
                    $html.='<p>CPU usage: <span class="label label-danger">' . $currentInfo['value'] . ' °C</span></p></br>';
                }
                $html.='<p>' . date_format(new DateTime($currentInfo['date']), "d M H:i") . '</p>';
                $html .= '</div>
                      </div>';
            }
            $html .='<p>Last cpu temperature by host</p>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayActiveUserTable($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $html = '<table class="table table-striped hidden-xs hidden-sm">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Request</th>
            </tr>';
            $cpuUsageByHost = $hostManager->getActiveUsers();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $html = $html . '<tr>';
                $html = $html . '<td>' . ($i + 1) . '</td>';
                $html = $html . '<td>' . $currentInfo['name'] . '</td>';
                $html = $html . '<td><span class="label label-default">' . $currentInfo['nbCall'] . '</span></td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

    public static function displayActiveUsertableRespon($db) {
        if (isset($_SESSION['SphereGuardLogged'])) {
            include_once 'model/HostManager.php';
            include_once 'model/Host.php';
            $hostManager = new HostManager($db);
            $cpuUsageByHost = $hostManager->getActiveUsers();
            for ($i = 0; $i < count($cpuUsageByHost); $i++) {
                $currentInfo = $cpuUsageByHost[$i];
                $hostObj = new Host(array());
                $hostObj = $hostManager->getHostById($currentInfo['fk_host']);
                $html .= '<div class="panel panel-default hidden-md hidden-lg">
                        <div class="panel-body">
                            <div class="panelHead">' . $currentInfo['name'] . '</div>';
                $html.='<p>nb of requests: <span class="label label-default">' . $currentInfo['nbCall'] . '</span></p></br>';
                $html .= '</div>
                      </div>';
            }
            $html .='<p>Most active users</p>';
            return $html;
        } else {
            $html = "";
            return $html;
        }
    }

}
