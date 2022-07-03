<?
    $mode=$_POST['mode'];
    if($mode==1){setcookie("dark",'/', time()+36000);echo'1';}
    else{setcookie("dark",'/', time()-36000);echo'0';}
?>