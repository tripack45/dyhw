<?php
    session_start();
    
    require_once('utils.php');
    
    requireLogin();
    
    header('Location: list.php');

?>