<?php

/**
 *
 * Clément Hampaï 
 * 
 */

class ApiHandler {

    private $_db;

    //Constructor
    //-----------

    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

    public function checkApiKey($apiKey, $apiUser) {
        $result = false;
        $q = $this->_db->prepare('SELECT * FROM api WHERE name =:name AND apikey =:key');
        $q->bindValue(':name', $apiUser, PDO::PARAM_STR);
        $q->bindValue(':key', $apiKey, PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $result = true;
        }
        return $result;
    }

    public function getAllHosts() {
        $allHosts = array();
        $q = $this->_db->prepare('SELECT * FROM `host`');
        $q->execute();

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $allHosts[] = $data;
        }
        return $allHosts;
    }

    public function getInfoByHost($hostId) {
        $allInfo = array();
        $q = $this->_db->prepare('( SELECT * FROM  `performance` inner join performance_type on fk_type = pk_type WHERE fk_host =:hostId order by date desc limit 5 ) order by pk_type');
        $q->bindValue(':hostId', $hostId, PDO::PARAM_STR);
        $q->execute();

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $allInfo[] = $data;
        }
        return $allInfo;
    }

    public function joinHostAndInfo($hostArray) {
        $result = "[";
        for ($i = 0; $i < count($hostArray); $i++) {
            $infoArray = $this->getInfoByHost($hostArray[$i]["pk_host"]);
            if (count($hostArray) <= 1 || $i == count($hostArray) - 1) {
                $result = $result . '{ "id":"' . $hostArray[$i]["pk_host"] . '" ,"name":"' . $hostArray[$i]["name"] . '" , "ip":"' . $hostArray[$i]["ip"] . '", "cpuTemp":"' . $infoArray[3]["value"] . '", "usedRam":"' . $infoArray[0]["value"] . '", "usedCpu":"' . $infoArray[1]["value"] . '", "diskUsage":"' . $infoArray[2]["value"] . '", "diskTemp":"' . $infoArray[4]["value"] . '"}';
            } else {
                $result = $result . '{ "id":"' . $hostArray[$i]["pk_host"] . '" ,"name":"' . $hostArray[$i]["name"] . '" , "ip":"' . $hostArray[$i]["ip"] . '", "cpuTemp":"' . $infoArray[3]["value"] . '", "usedRam":"' . $infoArray[0]["value"] . '", "usedCpu":"' . $infoArray[1]["value"] . '", "diskUsage":"' . $infoArray[2]["value"] . '", "diskTemp":"' . $infoArray[4]["value"] . '"},';
            }
        }
        $result = $result . "]";
        return $result;
    }

    public function getChartByHost($hostId) {
        $allInfo = array();
        $q = $this->_db->prepare('(SELECT * FROM  `performance` inner join performance_type on fk_type = pk_type WHERE fk_host =:hostId order by date desc limit 480) order by date asc');
        $q->bindValue(':hostId', $hostId, PDO::PARAM_STR);
        $q->execute();

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $allInfo[] = $data;
        }
        return $allInfo;
    }

    public function formatChartData($chartInfo) {
        $npCpuUsage = 0;
        $npCpuTemp = 0;
        $npRam = 0;
        $npDiskUsage = 0;
        $npDiskTemp = 0;
        $npDate = 0;

        $result = "{";
        $cpu = '"cpuUsage" : [';
        $cpuTemp = '"cpuTemp" : [';
        $ram = '"ramUsage" : [';
        $diskUsage = '"diskUsage" : [';
        $diskTemp = '"diskTemp" : [';
        $date = ',"date" : [';
        for ($i = 0; $i < count($chartInfo); $i++) {
            if ($chartInfo[$i]["name"] == "Cpu usage") {
                $npCpuUsage++;
                if ($npCpuUsage != 1) {
                    $cpu = $cpu . ',';
                }
                $cpu = $cpu . ' { "value":"' . $chartInfo[$i]["value"] . '" }';
            } else if ($chartInfo[$i]["name"] == "cpuTemp") {
                $npCpuTemp++;
                if ($npCpuTemp != 1) {
                    $cpuTemp = $cpuTemp . ',';
                }
                $cpuTemp = $cpuTemp . ' { "value":"' . $chartInfo[$i]["value"] . '" }';
            } else if ($chartInfo[$i]["name"] == "Used RAM") {
                $npRam++;
                if ($npRam != 1) {
                    $ram = $ram . ',';
                }
                $ram = $ram . ' { "value":"' . $chartInfo[$i]["value"] . '" }';
            } else if ($chartInfo[$i]["name"] == "Disk usage") {
                $npDiskUsage++;
                if ($npDiskUsage != 1) {
                    $diskUsage = $diskUsage . ',';
                }
                $diskUsage = $diskUsage . ' { "value":"' . $chartInfo[$i]["value"] . '" }';
            } else if ($chartInfo[$i]["name"] == "hddTemp") {
                $npDiskTemp++;
                if ($npDiskTemp != 1) {
                    $diskTemp = $diskTemp . ',';
                }
                $diskTemp = $diskTemp . ' { "value":"' . $chartInfo[$i]["value"] . '" }';
                $npDate++;
                if ($npDate != 1) {
                    $date = $date . ',';
                }
                $date = $date . ' { "value":"' . $chartInfo[$i]["date"] . '" }';
            }
        }
        $cpu = $cpu . '],';
        $cpuTemp = $cpuTemp . '],';
        $ram = $ram . '],';
        $diskUsage = $diskUsage . '],';
        $diskTemp = $diskTemp . ']';
        $date = $date . ']';

        $result = $result . $cpu . $cpuTemp . $ram . $diskUsage . $diskTemp . $date;
        return $result . "}";
    }

    public function formatInfoByHostData($chartInfo) {
        $npCpuUsage = 0;
        $npCpuTemp = 0;
        $npRam = 0;
        $npDiskUsage = 0;
        $npDiskTemp = 0;
        $npDate = 0;

        $result = "{";
        $cpu = '"cpuUsage" : [';
        $cpuTemp = '"cpuTemp" : [';
        $ram = '"ramUsage" : [';
        $diskUsage = '"diskUsage" : [';
        $diskTemp = '"diskTemp" : [';
        for ($i = 0; $i < count($chartInfo); $i++) {
            if ($chartInfo[$i]["name"] == "Cpu usage") {
                $npCpuUsage++;
                if ($npCpuUsage != 1) {
                    $cpu = $cpu . ',';
                }
                $cpu = $cpu . ' { "value":"' . $chartInfo[$i]["value"] . '" },';
                $cpu = $cpu . ' { "unit":"' . $chartInfo[$i]["unit"] . '" },';
                $cpu = $cpu . ' { "date":"' . $chartInfo[$i]["date"] . '" },';
                $cpu = $cpu . ' { "hostID":"' . $chartInfo[$i]["fk_host"] . '" }';
            } else if ($chartInfo[$i]["name"] == "cpuTemp") {
                $npCpuTemp++;
                if ($npCpuTemp != 1) {
                    $cpuTemp = $cpuTemp . ',';
                }
                $cpuTemp = $cpuTemp . ' { "value":"' . $chartInfo[$i]["value"] . '" },';
                $cpuTemp = $cpuTemp . ' { "unit":"' . $chartInfo[$i]["unit"] . '" },';
                $cpuTemp = $cpuTemp . ' { "date":"' . $chartInfo[$i]["date"] . '" },';
                $cpuTemp = $cpuTemp . ' { "hostID":"' . $chartInfo[$i]["fk_host"] . '" }';
            } else if ($chartInfo[$i]["name"] == "Used RAM") {
                $npRam++;
                if ($npRam != 1) {
                    $ram = $ram . ',';
                }
                $ram = $ram . ' { "value":"' . $chartInfo[$i]["value"] . '" },';
                $ram = $ram . ' { "unit":"' . $chartInfo[$i]["unit"] . '" },';
                $ram = $ram . ' { "date":"' . $chartInfo[$i]["date"] . '" },';
                $ram = $ram . ' { "hostID":"' . $chartInfo[$i]["fk_host"] . '" }';
            } else if ($chartInfo[$i]["name"] == "Disk usage") {
                $npDiskUsage++;
                if ($npDiskUsage != 1) {
                    $diskUsage = $diskUsage . ',';
                }
                $diskUsage = $diskUsage . ' { "value":"' . $chartInfo[$i]["value"] . '" },';
                $diskUsage = $diskUsage . ' { "unit":"' . $chartInfo[$i]["unit"] . '" },';
                $diskUsage = $diskUsage . ' { "date":"' . $chartInfo[$i]["date"] . '" },';
                $diskUsage = $diskUsage . ' { "hostID":"' . $chartInfo[$i]["fk_host"] . '" }';
            } else if ($chartInfo[$i]["name"] == "hddTemp") {
                $npDiskTemp++;
                if ($npDiskTemp != 1) {
                    $diskTemp = $diskTemp . ',';
                }
                $diskTemp = $diskTemp . ' { "value":"' . $chartInfo[$i]["value"] . '" },';
                $diskTemp = $diskTemp . ' { "unit":"' . $chartInfo[$i]["unit"] . '" },';
                $diskTemp = $diskTemp . ' { "date":"' . $chartInfo[$i]["date"] . '" },';
                $diskTemp = $diskTemp . ' { "hostID":"' . $chartInfo[$i]["fk_host"] . '" }';
            }
        }
        $cpu = $cpu . '],';
        $cpuTemp = $cpuTemp . '],';
        $ram = $ram . '],';
        $diskUsage = $diskUsage . '],';
        $diskTemp = $diskTemp . ']';

        $result = $result . $cpu . $cpuTemp . $ram . $diskUsage . $diskTemp;
        return $result . "}";
    }

    public function incrApiCall($apiUser) {
        $q = $this->_db->prepare('UPDATE `api` SET nbCall = nbCall + 1 WHERE `name` like :name');
        $q->bindValue(':name', $apiUser, PDO::PARAM_STR);
        $q->execute();
    }

    public function throwError($message) {
        $html = '{ "error":"';
        $html .= $message;
        $html .= '"}';
        return $html;
    }

}
