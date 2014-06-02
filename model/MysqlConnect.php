<?php

// Connexion à la base de données
try
{
    $db = new PDO('mysql:host=localhost;dbname=SphereGuard', 'guard', 'YourPassword');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
