<?php
    session_start();
    require_once('utils.php');
    requireLogin();
    
    $uid = $_SESSION['uid'];
    $content = $_POST['content'];
    
    if(empty($content)){
        errmsg('Error: Empty content!','list.php');
    }
    
    $SQLServer = new mysqli("localhost","dyhw","1234","dyhw1");
    if( $SQLServer -> connect_errno){
        die("SQL connection failed: ". $SQLServer -> connect_error);
    }
    
    $querryString = "INSERT INTO todolist (uid,content) VALUES ($uid,'$content');";
    $result = $SQLServer -> query($querryString);
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
        
    $SQLServer -> close();
    
    header('Location: list.php');

?>