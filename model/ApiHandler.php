<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api
 *
 * @author CypressXt
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
        $q = $this->_db->prepare('SELECT * FROM api WHERE name =:name AND api.key =:key');
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
        $q = $this->_db->prepare('SELECT * FROM  `performance` inner join performance_type on fk_type = pk_type WHERE fk_host =:hostId order by date desc limit 5');
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

}
