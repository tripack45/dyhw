<?php 
session_start();
require_once('utils.php');
require_once('config.php');

$username = $_POST['usrname'];
$password = $_POST['pswd'];
$uid = 0;

$SQLServer = connectSQLServer($sqlConfig);

$query = $SQLServer->prepare("SELECT * FROM user WHERE username=? AND password=?");
$query->bind_param('ss', $username, $password);
$query->execute();
$result = $query->get_result();

if ($SQLServer->errno) {
    die('SQL error: '.$SQLServer->error);
}

$SQLServer->close();

if ($result->num_rows == 0) {
    errmsg('Login Failed, Please return to login!', 'login.html');
} else {
    $row = $result->fetch_assoc();
    $_SESSION["isLoggedIn"] = TRUE;
    $_SESSION['uid'] = $row['uid'];
    $_SESSION["username"] = $row['username'];
    $uid = $row['uid'];
    errmsg("Welcome, $username. UID: $uid.", 'index.php');
}

?>