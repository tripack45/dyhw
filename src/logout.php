<?php
    session_Start();
    require_once('utils.php');
    
    if(!requireLogin()){
        $_SESSION['isLoggedIn']=FALSE;  
        errmsg('You have successfully logged out','login.html');
    }
 ?>
    