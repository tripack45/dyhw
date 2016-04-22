<?php
    session_start();
    require_once('utils.php');
    requireLogin();
    $uid      = $_SESSION['uid'];
    $username = $_SESSION['username'];
    
    $SQLServer = new mysqli("localhost","dyhw","1234","dyhw1");
    if( $SQLServer -> connect_errno){
        die("SQL connection failed: ". $SQLServer -> connect_error);
    }
    
    $result = $SQLServer -> query("SELECT * FROM todolist WHERE uid='$uid';");
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
        
    $SQLServer -> close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <title>List TODO list</title>
    </head>
    <body>
        <h1>Welcome, <?=$username?>: </h1>
        <h2>You are logged in, click to <a href="logout.php">logout</a></h2>
        <h2>Your todo list contains <?=$result->num_rows?> items, listed as follows</h2>
        <?php for($i=0;$i<$result->num_rows;$i++):?>
            <p> 
                <?php $row=$result->fetch_assoc();?>
                <a href="<?='deleteitem.php?itemid='.$row['itemid']?>">Del</a>|
                <a href="<?='editor.php?itemid='.$row['itemid']?>">Edit</a>|
                <?=$i+1?>. <?=$row['content']?>
            </p>
        <?php endfor; ?>
        <p>
            You can add a new entry by here:
            <form method="POST" action="additem.php">
                <textarea name="content" class="form-control center-block" style="width: 35vw; min-height: 5em;" placeholder="New Content"></textarea>
                <p><button>Submit</button></p>
            </form>
            
        </p>
    </body>
</html>
    