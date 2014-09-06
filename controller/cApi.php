<?php

/**
 *
 * Clément Hampaï
 * 
 */

//------------------------------------------------------------------------------
//                         Includes & variables                            
//------------------------------------------------------------------------------
include_once "model/MysqlConnect.php";
include_once "model/ApiHandler.php";


$api = new ApiHandler($db);
$apiKey = $_GET['key'];
$apiUser = $_GET['user'];
$function = $_GET['function'];
$inset = $_GET['inset'];


//------------------------------------------------------------------------------
//                            API fonctions                           
//------------------------------------------------------------------------------
if ($api->checkApiKey($apiKey, $apiUser)) {
    switch ($function) {
        case "getAllHosts":
            echo $api->joinHostAndInfo($api->getAllHosts());
            $api->incrApiCall($apiUser);
            break;

        case "getInfoByHost":
            if (isset($inset)) {
                $data = $api->getInfoByHost($inset);
                print_r($api->formatInfoByHostData($data));
                $api->incrApiCall($apiUser);
            } else {
                $api->throwError('getInfoByHost require an "inset" parameter, apparently you forgot it.');
            }
            break;

        case "getChartByHost":
            if (isset($inset)) {
                $chartData = $api->getChartByHost($inset);
                print_r($api->formatChartData($chartData));
                $api->incrApiCall($apiUser);
            } else {
                $api->throwError('getChartByHost require an "inset" parameter, apparently you forgot it.');
            }
            break;
        case false:
            $api->throwError("Nice try but you will be sanctionned for invalid fonction name ;) ");
            break;
    }
} else {
    $api->throwError("invalid api credentials");
}