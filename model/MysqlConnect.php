<?php


try
{
    $host='127.0.0.1';
    $dbName='sphereguard';
    $dbUser='user';
    $dbPassword='password';
    $db = new PDO('mysql:host=$host;dbname=$dbName', $dbUser, $dbPassword);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
