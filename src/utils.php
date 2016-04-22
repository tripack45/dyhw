<?php
function errmsg($msg, $loc){
    header("Location: errorPage.php?msg=$msg&ret=$loc");
    die();
}

function requireLogin(){
        if(empty($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn']!==TRUE){
            errmsg('Login Required.','login.html');
            return TRUE;
        }else{
            return FALSE;
        }
}
?>

