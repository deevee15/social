<?
    require("bd.php");
    $account=$_GET['acc'];
    if(!empty($account)){
        if($account==$_COOKIE['account']){echo'ok';}
        else{
            setcookie("account",$_COOKIE['account'],time()-300600,"/");
            echo'error';
        }
    }
    else{echo'error';}
?>