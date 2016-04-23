<?php
    require_once "bootstrap.php";
   
    $itemid   =  $_GET['itemid'];

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
    
    $content = $row['content'];
    
    $SQLServer -> close();    
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <title>Edit Your Item</title>
    </head>
    <body>
        <h1>Welcome, <?=$username?>: </h1>
        <h2>You are logged in, click to go <a href="list.php">back</a></h2>
        <h3>The following is your original content:</h3>
        <p><?=$content?></p>
        <h3>Edit this into </h3>
        <p>
            You can add a new entry by here:
            <form method="POST" action="edititem.php?itemid= <?=$itemid?> ">
                <textarea name="new_content" class="form-control center-block" style="width: 35vw; min-height: 5em;" placeholder="New Content"><?=$content?></textarea>
                <p><button>Edit</button></p>
            </form>
            
        </p>
    </body>
</html>