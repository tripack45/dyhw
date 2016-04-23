<?php
    session_start();
    
    require_once "utils.php";
    require_once "config.php";
    
    requireLogin();
    
    $uid      = $_SESSION['uid'];  
    $username = $_SESSION['username'];
    
    $SQLServer=connectSQLServer($sqlConfig);
    
 ?>