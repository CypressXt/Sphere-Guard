<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
