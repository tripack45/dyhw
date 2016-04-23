<?php
    session_start();
    include_once('utils.php');
    include_once('config.php');
    
    if(empty($_POST['usrname'])){
        errmsg('Require an user name!','register.html');
    }
    if(empty($_POST['pswd'])){
        errmsg('Require a valid password!','register.html');
    }
    if(empty($_POST['cpswd'])){
        errmsg('Require confirmation of password','register.html');
    }
    if($_POST['pswd']!==$_POST['cpswd']){
        errmsg('The confirmation password disagree with password','register.html');
    }
    
    $username        = $_POST['usrname'];
    $password        = $_POST['pswd'];
    
    //Validation of the form over
    $SQLServer=connectSQLServer($sqlConfig);
    
    $query = $SQLServer -> prepare("SELECT * FROM user WHERE username = ?");
    $query -> bind_param('s',$username);
    $query -> execute();
    $result = $query -> get_result();
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
    if($result -> num_rows > 0){
        errmsg('Username Already Taken!','register.html');
    }

    $query = $SQLServer -> prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    $query -> bind_param('ss',$username,$password);
    $query -> execute();
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
     
    $SQLServer -> close();
    errmsg("Register complete! Taking you to login.",'login.html');
?>