<?
    include_once("bd.php");
    $step=$_GET['step'];
    $get_login=$_GET['login'];
    if($step==1){
        $login=$_POST['forgotten_login'];
        $result = mysql_query("SELECT * FROM users WHERE email = '".$login."'");
        if(mysql_num_rows($result)==0){echo"<meta http-equiv='Refresh' content='0; URL=/forgotten.php?step=1&status=wrong'>";}
        else{
            echo"<meta http-equiv='Refresh' content='0; URL=/forgotten.php?step=2&status=sucessful&login=".$login."'>";
        }
    }
    elseif($step==2){
        $surname=$_POST['forgotten_surname'];
        $result = mysql_query("SELECT * FROM users WHERE email = '".$get_login."' AND surname = '".$surname."'");
        if(mysql_num_rows($result)==0){echo"<meta http-equiv='Refresh' content='0; URL=/forgotten.php?step=1&status=wrong'>";}
        else{
            echo"<meta http-equiv='Refresh' content='0; URL=/forgotten.php?step=3&status=sucessful&login=".$get_login."&surname=".$surname."'>";
        }
    }
?>