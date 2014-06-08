<?php

/*
 * CypressXt
 */

include_once ('view/ApiInstall.php');
checkInstall();
$dashboardError = $_SESSION['SphereGuardError'];
include_once 'view/ApiDashboard.php';
$_SESSION['SphereGuardError'] = "";

function checkInstall() {
    if (!file_exists("model/MysqlConnect.php") && isset($_POST['submitInstall']) && $_POST['inputDbHost'] != "" && $_POST['inputDbName'] != "" && $_POST['inputDbUser'] != "" && $_POST['inputDbPass'] != "") {
        $dbH = $_POST['inputDbHost'];
        $dbN = $_POST['inputDbName'];
        $dbU = $_POST['inputDbUser'];
        $dbP = $_POST['inputDbPass'];
        $content = '<?php ' . PHP_EOL . "\t" . 'try { ' . PHP_EOL . "\t\t" . '//## Config ########################' . PHP_EOL;
        $content = $content . "\t\t" . '$dbHost = "' . $dbH . '";' . PHP_EOL;
        $content = $content . "\t\t" . '$dbName = "' . $dbN . '";' . PHP_EOL;
        $content = $content . "\t\t" . '$dbUser = "' . $dbU . '";' . PHP_EOL;
        $content = $content . "\t\t" . '$dbPassword = "' . $dbP . '";' . PHP_EOL;
        $content = $content . "\t\t" . '//##################################' . PHP_EOL .
                "\t\t" . '$db = new PDO(\'mysql:host=\'.$dbHost.\';dbname=\' . $dbName, $dbUser, $dbPassword);' . PHP_EOL .
                "\t" . '} catch (Exception $e) {' . PHP_EOL .
                "\t\t" . 'die(\'Erreur : \' . $e->getMessage());' . PHP_EOL .
                "\t" . '}';
        $fp = fopen("model/MysqlConnect.php", "wb");
        fwrite($fp, $content);
        fclose($fp);
        $_SESSION['askedSphereGuard'] = "apiDashboard";
        header('Location: /SphereGuard/index.php?l=login');
    }
}
