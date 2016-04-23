<?php
    require_once "bootstrap.php";
    
    $content = $_POST['content'];
    
    if(empty($content)){
        $SQLServer -> close();
        errmsg('Error: Empty content!','list.php');
    }
    
    $query = $SQLServer -> prepare("INSERT INTO todolist (uid,content) VALUES (?,?)");
    $query -> bind_param('ds',$uid,$content);
    
    $query -> execute();
    $result = $query -> get_result();
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
        
    $SQLServer -> close();
    
    header('Location: list.php');

?>