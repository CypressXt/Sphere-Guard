<?php

include_once "model/PerformanceManager.php";


	$perfManager = new PerformanceManager($db);


$cpuPerfArray = $perfManager->getCpuUsage();
$cpuTempArray = $perfManager->getCPUTemp();
$chartValue = $perfManager->getAllCPUTemp();
$ramPerfArray = $perfManager->getRAMUsage();
$diskPerfArray = $perfManager->getDiskUsage();
$diskTempArray = $perfManager->getHDDTemp();
include_once "views/home.php";
