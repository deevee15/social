<?
    require("bd.php");
    $id=$_GET['id'];
    if(!empty($id)){
        $check_online = mysqli_query($mysqli,"SELECT online FROM users WHERE id='$id'");
        $get_result = mysqli_fetch_array($check_online);
        if($get_result['online']==1){echo'online';}
        else{
                $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE id = '$id'");
                while($row = mysqli_fetch_array($result)) {$last_login=$row['last_login'];}
                require_once $_SERVER['DOCUMENT_ROOT'].'/php-scripts/convert-date.php';
                $get_llogin=str_split($last_login);
                $get_llogin_month=$get_llogin[3].$get_llogin[4];
                $llogin_day=$get_llogin[0].$get_llogin[1];
                $llogin_year=$get_llogin[6].$get_llogin[7];
                $llogin_hour=$get_llogin[9].$get_llogin[10];
                $llogin_minute=$get_llogin[12].$get_llogin[13];
                $get_day=date('d');$get_month=date('m');$get_year=date('y');$get_h=date('H');$get_m=date('i');
                $calc_minutes=$get_m-$llogin_minute;
                if($get_day==$llogin_day and $get_month==$get_llogin_month and $get_year==$llogin_year and $get_h==$llogin_hour and $calc_minutes<=1){echo'Was online right now';}
                elseif($get_day==$llogin_day and $get_month==$get_llogin_month and $get_year==$llogin_year and $get_h==$llogin_hour and $calc_minutes<=5){echo'Was online '.$calc_minutes.' minutes ago';}
                elseif($get_day==$llogin_day and $get_month==$get_llogin_month and $get_year==$llogin_year){echo'Was online today at '.$llogin_hour.':'.$llogin_minute;}
                //else{echo'Was online '.$llogin_day.' '.$llogin_month.', 20'.$llogin_year.' at '.$llogin_hour.':'.$llogin_minute;}
                else {echo'Was online ';convert($last_login);}
        }
    }
?>