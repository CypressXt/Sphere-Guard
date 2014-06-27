<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cApi
 *
 * @author CypressXt
 */
include_once "model/MysqlConnect.php";
include_once "model/ApiHandler.php";


$api = new ApiHandler($db);
$apiKey = $_GET['key'];
$apiUser = $_GET['user'];
$function = $_GET['function'];
$inset = $_GET['inset'];

if ($api->checkApiKey($apiKey, $apiUser)) {
    switch ($function) {
        case "getAllHosts":
            echo $api->joinHostAndInfo($api->getAllHosts());
            break;
        case "getInfoByHost":
            $data = $api->getInfoByHost($inset);
            print_r($api->formatInfoByHostData($data));
            break;
        case "getChartByHost":
            $chartData = $api->getChartByHost($inset);
            print_r($api->formatChartData($chartData));
            break;
    }
}