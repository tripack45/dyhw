<?php
    session_start();
    include_once('utils.php');
    
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
    $SQLServer = new mysqli("localhost","dyhw","1234","dyhw1");
    if( $SQLServer -> connect_errno){
        die("SQL connection failed: ". $SQLServer -> connect_error);
    }
    
    $result = $SQLServer -> query("SELECT * FROM user WHERE username ='$username';");
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
    if($result -> num_rows > 0){
        errmsg('Username Already Taken!','register.html');
    }

    $SQLServer -> query("INSERT INTO user (username, password) VALUES ('$username', '$password');");
    
    if( $SQLServer -> errno){
        die('SQL error: '. $SQLServer -> error);
    }
     
    $SQLServer -> close();
    errmsg("Register complete! Taking you to login.",'login.html');
?>