<?php

/*
 * 
 * Clément Hampaï
 * 
 */

//------------------------------------------------------------------------------
//                         Destroy the current session                              
//------------------------------------------------------------------------------
$_SESSION['SphereGuardLogged'] = null;
unset($_SESSION);
session_destroy();
//------------------------------------------------------------------------------
//                         Redirect user after logout                              
//------------------------------------------------------------------------------
header('Location: /SphereGuard/');
session_start();
$_SESSION['askedSphereGuard'] = "apiDashboard";
