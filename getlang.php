<?
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
        while($row = mysql_fetch_array($result)) {
            $slg=$row['site_lang'];
            if($slg=='english'){setcookie("language","english",time()+300600,"/");}
            elseif($slg=='russian'){setcookie("language","russian",time()+300600,"/");}
            elseif($slg=='japanese'){setcookie("language","japanese",time()+300600,"/");}
        }
?>