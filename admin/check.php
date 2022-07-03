<?
    session_start();
    $pass=$_POST['admin_check'];
    if($pass='15018902'){
        $_SESSION['admined']=1;
    }
?>