<?php
    require_once "bootstrap.php";
   
    $new_content = $_POST['new_content'];
    $itemid      = $_GET['itemid'];
    
    $new_conent = htmlspecialchars($new_content);
    
    if(empty($new_content)){
        errmsg('Empty content! Consider deleting it?','list.php');
    }
    
    $query = $SQLServer -> prepare("SELECT * FROM todolist WHERE itemid=?");
    $query -> bind_param('d',$itemid);
    $query -> execute();   
    $result = $query -> get_result();
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
    
    $query = $SQLServer -> prepare("UPDATE todolist SET content=? WHERE itemid=?");
    $query -> bind_param('sd',$new_content,$itemid);
    $query -> execute();   
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
    
    header('Location: list.php');
    
    $SQLServer -> close();    
    
?>