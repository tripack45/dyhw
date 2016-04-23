<?php
    session_start();
    require_once('utils.php');
    require_once('config.php');
    
    $username = $_POST['usrname'];
    $password = $_POST['pswd'];
    $uid      = 0;
    
    $SQLServer=connectSQLServer($sqlConfig);
    
    $result = $SQLServer -> query("SELECT * FROM user WHERE username='$username' AND password='$password';");
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
        
    $SQLServer -> close();
    
    if($result -> num_rows == 0){
        errmsg('Login Failed, Please return to login!','login.html');
    }else{
        $row = $result -> fetch_assoc();
        $_SESSION["isLoggedIn"] = TRUE;
        $_SESSION['uid']        = $row['uid'];
        $_SESSION["username"]   = $row['username'];
        $uid = $row['uid'];
        errmsg("Welcome, $username. UID: $uid.",'index.php');
    }
    
?>

