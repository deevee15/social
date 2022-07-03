<?
    include_once("bd.php");
    session_start();
    $id=$_GET['id'];
    $inputed=$_POST['adm_pass'];
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
        while($row = mysql_fetch_array($result)) {
            $support=$row['support'];
            $user_id=$row['id'];
    }
    if($id==$user_id){
        if($support==1 and $inputed=='54gapaqz643'){setcookie("admined","positive",time()+3600,"/");}
        elseif($support==2 and $inputed=='87yteq208'){setcookie("admined","positive",time()+3600,"/");}
        elseif($support==3 and $inputed=='44kjDVV15'){setcookie("admined","positive",time()+3600,"/");}
        else{setcookie("admined","negative",time()+3600,"/");}
        echo"<meta http-equiv='Refresh' content='0; URL=/admin/'>";
    }
?>