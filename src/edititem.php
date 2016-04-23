<?php
    require_once "bootstrap.php";
   
    $new_content = $_POST['new_content'];
    $itemid      = $_GET['itemid'];
    
    $result = $SQLServer -> query("SELECT * FROM todolist WHERE itemid=$itemid;");
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
    
    if($result->num_rows == 0){
        $SQLServer -> close();
        errmsg('None existing entry','list.php');
    }
    
    $row=$result->fetch_assoc();
    
    if($row['uid']!=$uid){
        $SQLServer -> close();
        errmsg('Illegal Access','list.php');
    }
    
    $SQLServer -> query("UPDATE todolist SET content='$new_content' WHERE itemid=$itemid;");
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
    
    header('Location: list.php');
    
    $SQLServer -> close();    
    
?>