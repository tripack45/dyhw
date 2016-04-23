<?php
    require_once "bootstrap.php";
    
    $content = $_POST['content'];
    
    if(empty($content)){
        $SQLServer -> close();
        errmsg('Error: Empty content!','list.php');
    }
    
    $querryString = "INSERT INTO todolist (uid,content) VALUES ($uid,'$content');";
    $result = $SQLServer -> query($querryString);
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
        
    $SQLServer -> close();
    
    header('Location: list.php');

?>